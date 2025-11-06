<?php

namespace App\Repository;

use App\Entity\Passions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Passions>
 *
 * @method Passions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Passions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Passions[]    findAll()
 * @method Passions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PassionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Passions::class);
    }

    //    /**
    //     * @return Passions[] Returns an array of Passions objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Passions
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
