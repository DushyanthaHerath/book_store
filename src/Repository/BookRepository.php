<?php

namespace App\Repository;

use App\Entity\Book;
use App\Repository\Contracts\BookInterface;
use App\Repository\Contracts\BookRepoInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * Class BookRepository
 * @package App\Repository
 */
class BookRepository extends ServiceEntityRepository implements BookRepoInterface
{
    /**
     * BookRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * @param $filters
     * @return \Doctrine\ORM\Query
     */
    public function listBooks($filters) {
        $books = $this->createQueryBuilder('b');

        if(!empty($filters)) {
            foreach ($filters as $filter => $value){
                if($value) {
                    $books = $books->andWhere('b.' . $filter . ' = :val')
                        ->setParameter('val', $value);
                }
            }
        }

        return $books->orderBy('b.id', 'ASC')->getQuery();
    }

    /**
     * @param $bookId
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function get($bookId) {
        return $this->createQueryBuilder('b')
            ->andWhere('b.id = :val')
            ->setParameter('val', $bookId)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
