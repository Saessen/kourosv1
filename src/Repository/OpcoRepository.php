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

    /**
     * Rechercher les devis en fction du formulaire
     * @return void
     */
    public function search($mots = null){
        $final1 = str_replace(',', ' ', $mots);
        $final2 = str_replace(';', ' ', $final1);
        $final = str_replace('  ', ' ', $final2);
        $t = explode(' ', $final);
        $query = $this->createQueryBuilder('o');
        for($i=0; $i<count($t); $i++){
            if($i==0){
                $query->where(' o.nom LIKE :mots' )
                ->orWhere('o.nomContact LIKE :mots')
                ->orWhere('o.ville LIKE :mots')
                ->setParameter('mots', '%'.$t[$i].'%');
            }
        }
        return $query->getQuery()->getResult();
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
