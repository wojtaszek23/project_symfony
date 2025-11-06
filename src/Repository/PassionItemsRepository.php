<?php

namespace App\Repository;

use App\Entity\PassionItems;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PassionItems>
 *
 * @method PassionItems|null find($id, $lockMode = null, $lockVersion = null)
 * @method PassionItems|null findOneBy(array $criteria, array $orderBy = null)
 * @method PassionItems[]    findAll()
 * @method PassionItems[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PassionItemsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PassionItems::class);
    }

    //    /**
    //     * @return PassionItems[] Returns an array of PassionItems objects
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

    //    public function findOneBySomeField($value): ?PassionItems
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
