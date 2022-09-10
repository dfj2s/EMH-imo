<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\RechercheBiens;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder as ORMQueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }
    public function findAllVIsibleQuery(RechercheBiens $recherche ):Query
    {
        $query = $this->findVisibleQuery() ;

        if ($recherche->getPrixMax())
        {
          $query = $query
              -> andWhere('p.prix <= :prixMax')
              ->setParameter('prixMax',$recherche->getPrixMax());

        }
        if ($recherche->getSurfaceMin())
        {
          $query = $query
              -> andWhere('p.surface >= :surfacemin')
              ->setParameter('surfacemin',$recherche->getSurfaceMin());

        }
        if ($recherche->getOptions()->count() > 0)
        {
            $k=0;
            foreach($recherche->getOptions() as $k => $option) {
            $k++;
            $query = $query
                -> andWhere(":option$k MEMBER OF p.options")
                ->setParameter("option$k",$option);
            }

  
          }

        return $query->getQuery();
    }
    public function findLatest()
    {
        return $this->findVisibleQuery()
        ->where("p.vendue=false")
        ->setMaxResults(4)
        ->getQuery()
        ->getResult();
    }
    private function findVisibleQuery() :ORMQueryBuilder
    {
        return $this->createQueryBuilder("p")
        ->where("p.vendue=false");

    }
    


    // /**
    //  * @return Property[] Returns an array of Property objects
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
    public function findOneBySomeField($value): ?Property
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
