<?php

namespace App\Repository;

use App\Entity\Prospects;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Prospects|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prospects|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prospects[]    findAll()
 * @method Prospects[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProspectsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prospects::class);
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
        $query = $this->createQueryBuilder('p')
        ->join('p.entreprise', 'e');
        for($i=0; $i<count($t); $i++){
            if($i==0){
                $query->where(' e.denominationSociale LIKE :mots' )
                ->orWhere('p.nom LIKE :mots')
                ->orWhere('p.prenom LIKE :mots')
                ->setParameter('mots', '%'.$t[$i].'%');
            }
        }
        return $query->getQuery()->getResult();
    }
    // /**
    //  * @return Prospects[] Returns an array of Prospects objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Prospects
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
