<?php

namespace App\Repository;

use App\Entity\FamilleService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FamilleService|null find($id, $lockMode = null, $lockVersion = null)
 * @method FamilleService|null findOneBy(array $criteria, array $orderBy = null)
 * @method FamilleService[]    findAll()
 * @method FamilleService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FamilleServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FamilleService::class);
    }

    // /**
    //  * @return FamilleService[] Returns an array of FamilleService objects
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
    public function findOneBySomeField($value): ?FamilleService
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
