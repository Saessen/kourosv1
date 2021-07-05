<?php

namespace App\Repository;

use App\Entity\Opco;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Opco|null find($id, $lockMode = null, $lockVersion = null)
 * @method Opco|null findOneBy(array $criteria, array $orderBy = null)
 * @method Opco[]    findAll()
 * @method Opco[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OpcoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Opco::class);
    }

    // /**
    //  * @return Opco[] Returns an array of Opco objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Opco
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
