<?php

namespace App\Repository;

use App\Entity\Formateurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Formateurs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Formateurs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Formateurs[]    findAll()
 * @method Formateurs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormateursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Formateurs::class);
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
        $query = $this->createQueryBuilder('f')
        ->join('f.formations', 'ff');
        for($i=0; $i<count($t); $i++){
            if($i==0){
                $query->where(' f.nom LIKE :mots' )
                ->orWhere('f.prenom LIKE :mots')
                ->orWhere('ff.titre LIKE :mots')
                ->setParameter('mots', '%'.$t[$i].'%');
        }else{
            $query->orWhere(' f.nom LIKE :mots'.$i )
            ->orWhere('p.prenom LIKE :mots'.$i)
            ->orWhere('ff.titre LIKE :mots')
            ->setParameter('mots'.$i, '%'.$t[$i].'%');
        
        }
        return $query->getQuery()->getResult();
    }
    // /**
    //  * @return Formateurs[] Returns an array of Formateurs objects
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
    public function findOneBySomeField($value): ?Formateurs
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
}