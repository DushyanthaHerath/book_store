<?php


namespace App\Tests\Cart;


use App\Entity\Book;
use App\Service\Cart\Cart;
use App\Service\Cart\Item;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CartTest extends KernelTestCase
{
    public function testValues()
    {
        self::bootKernel();
        $container = self::$kernel->getContainer();
        $container = self::$container; // Private Services
        $bookRepo = self::$container->get('App\Repository\Contracts\BookRepoInterface');
        $promoRepo = self::$container->get('App\Repository\Contracts\PromoRepoInterface');

        $cart = new Cart();
        $cart->addPromos($promoRepo->getActivePromos());

        $total = 0;
        $childrenBooksCount = 0;

        for ($i=1; $i <= 20; $i++) {
            $book = $bookRepo->get($i);

            $total += $book->getPrice();

            if($book->getCategoryId() == 1)
                $childrenBooksCount++;

            $item = new Item();
            $item->setBook($book);
            $item->setQty(1);

            $cart->addItem($item);
            $cart->calculateSubTotals();
            $cart->applyDiscounts();
            $cart->calculateGrandTotal();
        }

        // Test Total
        $this->assertEquals(array_sum(array_map(
            function ($item) {
                return $item['sub_total'] ?? 0;
            }
        , $cart->toArray()['items'])), $total);

        // Test Discount
        if($childrenBooksCount > 5)
            $this->assertLessThan($total, $cart->toArray()['grand_total']);
    }
}
