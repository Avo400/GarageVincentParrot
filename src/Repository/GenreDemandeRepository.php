<?php

namespace App\Repository;

use App\Entity\GenreDemande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GenreDemande>
 *
 * @method GenreDemande|null find($id, $lockMode = null, $lockVersion = null)
 * @method GenreDemande|null findOneBy(array $criteria, array $orderBy = null)
 * @method GenreDemande[]    findAll()
 * @method GenreDemande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GenreDemandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GenreDemande::class);
    }

//    /**
//     * @return GenreDemande[] Returns an array of GenreDemande objects
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

//    public function findOneBySomeField($value): ?GenreDemande
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
