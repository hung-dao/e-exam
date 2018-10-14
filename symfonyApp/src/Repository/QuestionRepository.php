<?php

namespace App\Repository;

use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Question|null find($id, $lockMode = null, $lockVersion = null)
 * @method Question|null findOneBy(array $criteria, array $orderBy = null)
 * @method Question[]    findAll()
 * @method Question[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Question::class);
    }

//    /**
//     * @return Question[] Returns an array of Question objects
//     */
    public function queryOwnedBy($cateID) {
        $qb = $this->createQueryBuilder('c')
            ->andWhere('c.category = :category')
            ->setParameter('category', $cateID)
            ->getQuery()
            ->getResult();

        return $qb;
    }

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
    public function findOneBySomeField($value): ?Question
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * @param $value
     * @param $number
     * @return mixed
     */
    public function findQuestionsByCategory($value, $number)
    {
        return $this->createQueryBuilder('query')
            ->andWhere('query.category = :cat')
            ->setParameter('cat', $value)
            ->orderBy('query.id', 'ASC') //TODO order by random or another way to get the random questions
            ->setMaxResults($number)
            ->getQuery()
            ->getResult();
    }

}
