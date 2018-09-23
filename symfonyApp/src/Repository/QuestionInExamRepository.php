<?php

namespace App\Repository;

use App\Entity\QuestionInExam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method QuestionInExam|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionInExam|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionInExam[]    findAll()
 * @method QuestionInExam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionInExamRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, QuestionInExam::class);
    }

//    /**
//     * @return QuestionInExam[] Returns an array of QuestionInExam objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuestionInExam
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
