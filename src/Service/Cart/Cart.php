<?php


namespace App\Service\Cart;


use App\Repository\CategoryRepository;
use App\Service\Cart\Contracts\PaymentStrategy;

class Cart implements PaymentStrategy
{
    protected $items;
    protected $promos;

    protected $coupon;
    protected $discount;
    protected $totalDiscount;
    protected $total;
    protected $grandTotal;
    protected $subTotals;
    protected $appliedPromos;

    /**
     * Cart constructor.
     */
    public function __construct()
    {
        $this->items = [];
        $this->appliedPromos = [];
        $this->discount = [];
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param Item $item
     * @return $this
     */
    public function addItem(Item $item) {
        $this->items[] = $item;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @return $this
     */
    public function calculateSubTotals()
    {
        $total = [];
        foreach ($this->items as $item) {
            $categoryId = $item->getBook()->getCategoryId();
            $total[$categoryId] = $total[$categoryId] ?? 0;
            $total[$categoryId] = $total[$categoryId] + $item->getBook()->getPrice() * ($item->getQty() ?? 1);
        }
        $this->subTotals = $total;
        return $this;
    }

    /**
     * @return $this
     */
    public function applyDiscounts()
    {
        $categoryWise = [];
        if($this->items) {
            foreach ($this->items as $item) {
                $categoryId = $item->getBook()->getCategoryId();
                $categoryWise[$categoryId] = $categoryWise[$categoryId] ?? 0;
                $categoryWise[$categoryId] = $categoryWise[$categoryId] + 1;
            }

            if(!empty($this->promos) && empty($this->coupons)) {
                foreach ($categoryWise as $categoryId => $count) {
                    foreach ($this->promos as $promo) {
                        // Category specific price rules
                        if ($promo->getCategoryId() == $categoryId && $count >= $promo->getItemCount() && !in_array($promo->getId(),$this->appliedPromos)) {
                            $this->discount[$categoryId] = $this->discount[$categoryId] ?? 0;
                            $this->discount[$categoryId] += $promo->getDiscount();
                            $this->appliedPromos[] = $promo->getId();
                        }
                        // Item count specific price rules
                        if (empty($promo->getCategoryId()) && $count >= $promo->getItemCount()  && !in_array($promo->getId(),$this->appliedPromos)) {
                            $this->totalDiscount = $this->totalDiscount ?? 0;
                            $this->totalDiscount += $promo->getDiscount();
                            $this->appliedPromos[] = $promo->getId();
                        }
                    }
                }
            } elseif (!empty($this->coupons)) {
                $this->totalDiscount = $this->coupon->getDiscount();
            }
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function calculateGrandTotal() {
        $gndTot = 0;
        foreach ($this->subTotals as $categoryId => $total) {
            if(isset($this->discount[$categoryId])) {
                $gndTot += ($total - (($total*$this->discount[$categoryId])/100));
            } else  {
                $gndTot += $total;
            }
        }
        $this->total = $gndTot;
        $this->grandTotal = empty($this->totalDiscount) ? $gndTot : ($gndTot - (($gndTot*$this->totalDiscount)/100));
    }

    /**
     * Cart to Array
     */
    public function toArray() {
        $arr = [
            'total' => $this->total,
            'grand_total' => $this->grandTotal,
            'items' => $this->mapItems()
        ];
        return $arr;
    }

    /**
     * @return array
     */
    private function mapItems() {
        $items = [];
        $categories = [];
        foreach ($this->items as $item) {
            $categoryId = $item->getBook()->getCategoryId();
            $categoryName = $item->getBook()->getCategory()->getName();

            $items[$categoryId][] = [
                'id'=>$item->getBook()->getId(),
                'name'=>$item->getBook()->getName(),
                'qty'=>$item->getQty(),
                'price'=>$item->getBook()->getPrice()
            ];

            $categories[$categoryId] = [
                'name'=> $categoryName,
                'sub_total' => $this->subTotals[$categoryId] ?? 0,
                'discount' => $this->discount[$categoryId] ?? 0,
                'total' => isset($this->subTotals[$categoryId]) && isset($this->discount[$categoryId]) ?
                    ($this->subTotals[$categoryId] - (($this->subTotals[$categoryId]*$this->discount[$categoryId])/100)) : 0
            ];
        }
        $mapped = [];
        foreach ($categories as $id=>$category) {
            $category['books'] = $items[$id];
            $mapped[] = $category;
        }
        return $mapped;
    }

    /**
     * @required
     */
    public function getPromoService(PromoInterface $service) {
        $this->promoService = $service;
    }

    /**
     * @param $promos
     * @return $this
     */
    public function addPromos($promos) {
        $this->promos = [];
        foreach ($promos as $promo) {
            $this->promos[] = $promo;
        }
        return $this;
    }

    /**
     * @param $coupon
     * @return $this
     */
    public function setCoupon($coupon) {
        $this->coupon = $coupon;
        return $this;
    }
}
