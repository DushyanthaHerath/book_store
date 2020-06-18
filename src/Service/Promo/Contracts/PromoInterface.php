<?php


namespace App\Service\Promo\Contracts;


interface PromoInterface
{
    public function getActivePromos();

    public function getCoupon($code);
}
