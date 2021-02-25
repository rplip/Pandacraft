<?php

namespace App\Repository;

use App\Entity\Products;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Products|null find($id, $lockMode = null, $lockVersion = null)
 * @method Products|null findOneBy(array $criteria, array $orderBy = null)
 * @method Products[]    findAll()
 * @method Products[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Products::class);
    }


    /* Précision :
                    La méthode findAll() existe déjà,
                    ici je l'ai réécrit afin d'avoir un ordre d'affichage particulier
    */
    public function findAll()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.productcode', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
}
