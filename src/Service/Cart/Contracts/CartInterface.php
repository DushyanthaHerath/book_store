<?php


namespace App\Service\Cart\Contracts;


use Symfony\Component\HttpFoundation\Request;

interface CartInterface
{
    public function addToCart(Request $request);
    public function clearCart();
    public function applyCoupon(Request $request);
}
