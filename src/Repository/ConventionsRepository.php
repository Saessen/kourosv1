<?php

namespace App\Repository;

use App\Entity\Conventions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Conventions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Conventions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Conventions[]    findAll()
 * @method Conventions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConventionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Conventions::class);
    }

    /**
     * Rechercher les devis en fction du formulaire
     * @return void
     */
    public function search($mots = null){
        $final1 = str_replace(',', ' ', $mots);
        $final2 = str_replace(';', ' ', $final1);
        $final = str_replace('  ', ' ', $final2);
        $t = explode(' ', $final);
        $query = $this->createQueryBuilder('c');
        for($i=0; $i<count($t); $i++){
            if($i==0){
                $query->where(' c.lieuFormation LIKE :mots' )

                ->setParameter('mots', '%'.$t[$i].'%');
            }
        }
    // /**
    //  * @return Conventions[] Returns an array of Conventions objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Conventions
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
}