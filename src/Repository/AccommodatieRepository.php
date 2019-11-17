<?php

namespace App\Repository;

use App\Entity\Accommodatie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Accommodatie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Accommodatie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Accommodatie[]    findAll()
 * @method Accommodatie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccommodatieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Accommodatie::class);
    }

    // /**
    //  * @return Accommodatie[] Returns an array of Accommodatie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Accommodatie
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
