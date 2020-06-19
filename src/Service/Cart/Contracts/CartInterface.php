<?php


namespace App\Service\Cart\Contracts;


use Symfony\Component\HttpFoundation\Request;

interface CartInterface
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function addToCart(Request $request);

    /**
     * @return mixed
     */
    public function clearCart();

    /**
     * @param Request $request
     * @return mixed
     */
    public function applyCoupon(Request $request);
}
