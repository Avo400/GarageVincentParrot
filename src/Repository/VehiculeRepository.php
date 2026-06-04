<?php

namespace App\Repository;

use App\Data\SearchDataTest;
use App\Entity\Vehicule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @extends ServiceEntityRepository<Vehicule>
 *
 * @method Vehicule|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicule|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vehicule[]    findAll()
 * @method Vehicule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehiculeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Vehicule::class);
        $this->paginator = $paginator;
    }

    public function findVehiculePaginated(int $page, int $limit = 6): array 
    {
        // On veut que limit soit une valeur positive
        $limit = abs($limit);
        $result = [];

        // Créons la requête qui va chercher les infos d'un véhicule.
        $query = $this->getEntityManager()->createQueryBuilder()
        ->select('v')
        ->from(Vehicule::class,'v')
        ->setMaxResults($limit)
        ->setFirstResult(($page * $limit) - $limit);
        
        $paginator = new Paginator($query);
        $data = $paginator->getQuery()->getResult();
        // On vérifie qu'on a des données 
        if (empty($data)) {
            return $result;
        }  
        // On calcule le nombre de pages
        // Exemple : J'ai 5 véhicules pour une limite de 3. 5/3 = 1.66 donc on va arrondir 1.66 (avec ceil) à 2. -> 2 pages.
        $pages = ceil($paginator->count() / $limit);

        // On remplit le tableau
        $result['data'] = $data;
        $result['pages'] = $pages;
        $result['page'] = $page;
        $result['limit'] = $limit;
        return $result;
    }

    public function findSearch(SearchDataTest $search) : PaginationInterface
    {

        $query = $this->getSearchQuery($search)->getQuery();
        return $this->paginator->paginate(
           $query,
           $search->page,
           6
        );

    }
    public function findMinMaxPrice(SearchDataTest $search) : array
    {
        $results = $this->getSearchQuery($search)
        ->select('MIN(v.prix) as minPrice', 'MAX(v.prix) as maxPrice')
        ->getQuery()
        ->getScalarResult();
        return [(int)$results[0]['minPrice'], (int)$results[0]['maxPrice']];
    }

    public function findMinMaxKms(SearchDataTest $search) : array
    {
        $results = $this->getSearchQuery($search)
        ->select('MIN(v.kms) as minKms', 'MAX(v.kms) as maxKms')
        ->getQuery()
        ->getScalarResult();
        return [(int)$results[0]['minKms'], (int)$results[0]['maxKms']];
    }

    
    public function findMinMaxYear(SearchDataTest $search) : array
    {
        $results = $this->getSearchQuery($search)
        ->select('MIN(v.anneeMiseEnCirculation) as minYear', 'MAX(v.anneeMiseEnCirculation) as maxYear')
        ->getQuery()
        ->getScalarResult();
        return [(int)$results[0]['minYear'], (int)$results[0]['maxYear']];
    }

    private function getSearchQuery(SearchDataTest $search) : QueryBuilder
    {
        $query = $this
        ->createQueryBuilder('v');

        if (!empty($search->minPrice)) {
            $query = $query 
            ->andWhere('v.prix >= :minPrice')
            ->setParameter('minPrice',$search->minPrice);
        }
        if (!empty($search->maxPrice)) {
            $query = $query 
            ->andWhere('v.prix <= :maxPrice')
            ->setParameter('maxPrice',$search->maxPrice);
        }
        if (!empty($search->minKms)) {
            $query = $query 
            ->andWhere('v.kms >= :minKms')
            ->setParameter('minKms',$search->minKms);
        }
        if (!empty($search->maxKms)) {
            $query = $query 
            ->andWhere('v.kms <= :maxKms')
            ->setParameter('maxKms',$search->maxKms);
        }

        if (!empty($search->minYear)) {
            $query = $query 
            ->andWhere('v.anneeMiseEnCirculation >= :minYear')
            ->setParameter('minYear',$search->minYear);
        }
        if (!empty($search->maxYear)) {
            $query = $query 
            ->andWhere('v.anneeMiseEnCirculation <= :maxYear')
            ->setParameter('maxYear', $search->maxYear);
        }
            
            return $query;
    }

//    /**
//     * @return Vehicule[] Returns an array of Vehicule objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Vehicule
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
