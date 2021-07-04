<?php

namespace App\Repository;

use App\Entity\Formations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Formations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Formations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Formations[]    findAll()
 * @method Formations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Formations::class);
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
        $query = $this->createQueryBuilder('f');
        for($i=0; $i<count($t); $i++){
            if($i==0){
                $query->where(' f.titre LIKE :mots' )
                ->orWhere('f.programme LIKE :mots')
                ->setParameter('mots', '%'.$t[$i].'%');
            }
        }
        return $query->getQuery()->getResult();
    }
    // /**
    //  * @return Formations[] Returns an array of Formations objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Formations
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
