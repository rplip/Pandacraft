<?php

namespace App\Repository;

use App\Entity\Productlines;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Productlines|null find($id, $lockMode = null, $lockVersion = null)
 * @method Productlines|null findOneBy(array $criteria, array $orderBy = null)
 * @method Productlines[]    findAll()
 * @method Productlines[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductlinesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Productlines::class);
    }

    public function findByName($value)
    {
        return $this->createQueryBuilder('p')
            ->Where('p.productline = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
