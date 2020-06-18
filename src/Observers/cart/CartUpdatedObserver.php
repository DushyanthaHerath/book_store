<?php


namespace App\Observers\cart;


use App\Observers\ObserverInterface;
use App\Service\Cart\Cart;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartUpdatedObserver implements ObserverInterface
{
    protected $cart;
    protected $session;
    public function __construct(Cart $cart, SessionInterface $session)
    {
        $this->session = $session;
        $this->cart = $cart;
    }

    public function handle()
    {
        $this->session->set('cart', serialize($this->cart));
    }

    public static function instance(Cart $cart, SessionInterface $session) {
        return new static($cart, $session);
    }
}
