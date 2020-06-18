<?php


namespace App\Service\Promo;


use App\Repository\Contracts\PromoRepoInterface;
use App\Service\Promo\Contracts\PromoInterface;

class PromoService implements PromoInterface
{
    protected $repository;
    public function __construct(PromoRepoInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getActivePromos()
    {
        return $this->repository->getActivePromos();
    }

    public function getCoupon($code)
    {
        return $this->repository->getCoupon($code);
    }
}
