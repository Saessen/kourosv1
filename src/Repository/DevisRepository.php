<?php

namespace App\Repository;

use App\Entity\Devis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Devis|null find($id, $lockMode = null, $lockVersion = null)
 * @method Devis|null findOneBy(array $criteria, array $orderBy = null)
 * @method Devis[]    findAll()
 * @method Devis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DevisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Devis::class);
    }

    /**
     * Rechercher les devis en fction du formulaire
     * @return void
     */
    public function search($mots = null/*, $prospect = null, $formation = null*/){
        $final1 = str_replace(',', ' ', $mots);
        $final2 = str_replace(';', ' ', $final1);
        $final = str_replace('  ', ' ', $final2);
        $t = explode(' ', $final);
        $query = $this->createQueryBuilder('d')
// ANCHOR 
        ->join('d.prospect', 'c');
        for($i=0; $i<count($t); $i++){
            if($i==0){
                $query->where(' d.client LIKE :mots' )
                ->orWhere('p.clint.entreprise LIKE :mots')
                ->setParameter('mots', '%'.$t[$i].'%');
            }
        }

    // /**
    //  * @return Devis[] Returns an array of Devis objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Devis
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    }
}