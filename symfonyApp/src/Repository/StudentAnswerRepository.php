<?php

namespace App\Repository;

use App\Entity\StudentAnswer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method StudentAnswer|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudentAnswer|null findOneBy(array $criteria, array $orderBy = null)
 * @method StudentAnswer[]    findAll()
 * @method StudentAnswer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentAnswerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, StudentAnswer::class);
    }

//    /**
//     * @return StudentAnswer[] Returns an array of StudentAnswer objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StudentAnswer
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
