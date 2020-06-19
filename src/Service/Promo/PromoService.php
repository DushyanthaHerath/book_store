<?php


namespace App\Service\Promo;


use App\Repository\Contracts\PromoRepoInterface;
use App\Service\Promo\Contracts\PromoInterface;

class PromoService implements PromoInterface
{
    protected $repository;

    /**
     * PromoService constructor.
     * @param PromoRepoInterface $repository
     */
    public function __construct(PromoRepoInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return mixed
     */
    public function getActivePromos()
    {
        return $this->repository->getActivePromos();
    }

    /**
     * @param $code
     * @return mixed
     */
    public function getCoupon($code)
    {
        return $this->repository->getCoupon($code);
    }
}
