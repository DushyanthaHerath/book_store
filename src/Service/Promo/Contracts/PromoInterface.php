<?php


namespace App\Service\Promo\Contracts;


interface PromoInterface
{
    /**
     * @return mixed
     */
    public function getActivePromos();

    /**
     * @param $code
     * @return mixed
     */
    public function getCoupon($code);
}
