<?php

namespace App\Repository;

use App\Entity\Greetings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Greetings>
 *
 * @method Greetings|null find($id, $lockMode = null, $lockVersion = null)
 * @method Greetings|null findOneBy(array $criteria, array $orderBy = null)
 * @method Greetings[]    findAll()
 * @method Greetings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GreetingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Greetings::class);
    }

    //    /**
    //     * @return Greetings[] Returns an array of Greetings objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Greetings
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
