<?php

namespace App\Repository;

use App\Entity\Bornes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bornes>
 *
 * @method Bornes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bornes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bornes[]    findAll()
 * @method Bornes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BornesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bornes::class);
    }

//    /**
//     * @return Bornes[] Returns an array of Bornes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Bornes
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
