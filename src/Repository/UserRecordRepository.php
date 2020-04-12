<?php

namespace App\Repository;

use App\Entity\UserRecord;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserRecord|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserRecord|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserRecord[]    findAll()
 * @method UserRecord[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRecordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserRecord::class);
    }

    // /**
    //  * @return UserRecord[] Returns an array of UserRecord objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserRecord
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
