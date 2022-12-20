<?php

namespace App\Repository;

use App\Entity\BKEquipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BKEquipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method BKEquipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method BKEquipe[]    findAll()
 * @method BKEquipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BKEquipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BKEquipe::class);
    }

    // /**
    //  * @return BKEquipe[] Returns an array of BKEquipe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BKEquipe
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
