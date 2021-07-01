<?php

namespace App\Repository;

use App\Entity\IdeeCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IdeeCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method IdeeCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method IdeeCategory[]    findAll()
 * @method IdeeCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdeeCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IdeeCategory::class);
    }

    // /**
    //  * @return IdeeCategory[] Returns an array of IdeeCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IdeeCategory
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
