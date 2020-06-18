<?php


namespace App\Service\Cart;


use App\Observers\cart\CartUpdatedObserver;
use App\Repository\Contracts\BookRepoInterface;
use App\Repository\Contracts\PromoRepoInterface;
use App\Service\Cart\Contracts\CartInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService implements CartInterface
{
    protected $promoRepo;
    protected $bookRepository;
    public $session;
    protected $observers;
    /**
     * @var Cart $cart;
     */
    protected $cart;
    public function __construct(SessionInterface $session, BookRepoInterface $bookRepo, PromoRepoInterface $promoRepo)
    {
        $this->session = $session;
        $this->bookRepository = $bookRepo;
        $this->promoRepo = $promoRepo;
        if(empty($session->get('cart'))) {
            $this->cart = (new Cart())->addPromos($promoRepo->getActivePromos());
            $this->session->set('cart', serialize($this->cart));
        } else {
            $this->cart = unserialize($this->session->get('cart'));
        }

        $this->registerObservers();
    }

    public function addToCart(Request $request) {
        // args
        $bookId = $request->get('book_id');
        $qty = $request->get('qty', 1);
        // Item
        $book = $this->bookRepository->get($bookId);

        if($bookId) {
            $this->cart->addItem((
                new Item())
                ->setBook($book)
                ->setQty($qty)
            )
            ->calculateSubTotals()
            ->applyDiscounts()
            ->calculateGrandTotal();
            $this->cartUpdated();
        }
        return $this->cart->toArray();
    }

    private function cartUpdated() {
        foreach ($this->observers as $observer) {
            $observer->handle($this->cart);
        }
    }

    private function registerObservers() {
        $this->observers[] = CartUpdatedObserver::instance($this->cart, $this->session);
    }

    public function clearCart() {
        $this->cart = new Cart();
        $this->session->invalidate();
        //$this->cartUpdated();
        return $this->cart->toArray();
    }

    public function getCart() {
        return $this->cart->toArray();
    }

    public function applyCoupon(Request $request) {
        $code = $request->get('coupon');
        $coupon = $this->promoRepo->getCoupon($code);
        if($coupon) {
            $this->cart
                    ->setCoupon($coupon)
                    ->calculateSubTotals()
                    ->applyDiscounts()
                    ->calculateGrandTotal();
            $this->cartUpdated();
        }
    }
}
