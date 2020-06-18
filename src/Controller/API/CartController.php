<?php


namespace App\Controller\API;


use App\Service\Cart\Contracts\CartInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cart")
 */
class CartController extends BaseController
{
    protected $service;

    public function __construct(CartInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @return CartInterface
     */
    public function getService(): CartInterface
    {
        return $this->service;
    }

    /**
     * @Route("/add")
     */
    public function addToCart(Request $request) {
        return $this->sendResponse($this->getService()->addToCart($request));
    }

    /**
     * @Route("/clear", methods={"PUT"})
     */
    public function clearCart() {
        return $this->sendResponse($this->getService()->clearCart());
    }

    /**
     * @Route("/")
     */
    public function getCart() {
        return $this->sendResponse($this->getService()->getCart());
    }

    /**
     * @Route("/promo")
     */
    public function applyCoupon(Request $request) {
        return $this->sendResponse($this->getService()->applyCoupon($request));
    }
}
