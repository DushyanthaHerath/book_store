<?php


namespace App\Repository\Contracts;


interface PromoRepoInterface
{
    public function getActivePromos();

    public function getCoupon($code);
}
