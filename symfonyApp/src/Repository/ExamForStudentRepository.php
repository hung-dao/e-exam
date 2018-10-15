<?php

namespace App\Repository;

use App\Entity\ExamForStudent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ExamForStudent|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExamForStudent|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExamForStudent[]    findAll()
 * @method ExamForStudent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExamForStudentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ExamForStudent::class);
    }

//    /**
//     * @return ExamForStudent[] Returns an array of ExamForStudent objects
//     */
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
    public function findOneBySomeField($value): ?ExamForStudent
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
