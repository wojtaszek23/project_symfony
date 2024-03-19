<?php

namespace App\Repository;

use App\Entity\CookingRecipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CookingRecipe>
 *
 * @method CookingRecipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method CookingRecipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method CookingRecipe[]    findAll()
 * @method CookingRecipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CookingRecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CookingRecipe::class);
    }

    //    /**
    //     * @return CookingRecipe[] Returns an array of CookingRecipe objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?CookingRecipe
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
