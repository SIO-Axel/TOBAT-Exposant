<?php

namespace App\Repository;

use App\Entity\Exposant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Exposant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exposant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exposant[]    findAll()
 * @method Exposant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExposantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exposant::class);
    }

    // /**
    //  * @return Exposant[] Returns an array of Exposant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Exposant
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
