<?php

namespace App\Repository;

use App\Entity\Promos;
use App\Repository\Contracts\PromoRepoInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class PromosRepository
 * @package App\Repository
 */
class PromosRepository extends ServiceEntityRepository implements PromoRepoInterface
{
    /**
     * PromosRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Promos::class);
    }

    /**
     * @return mixed
     */
    public function getActivePromos()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.active = :val')
            ->setParameter('val', 1)
            ->orderBy('p.priority', 'desc')
            ->getQuery()
            ->getResult();
    }


    /**
     * @param $code
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getCoupon($code)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.active = :active')
            ->setParameter('active', 1)
            ->andWhere('p.code = :code')
            ->setParameter('code', $code)
            ->orderBy('p.priority', 'desc')
            ->getQuery()
            ->getOneOrNullResult();
    }
}
