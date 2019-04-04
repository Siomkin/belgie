<?php

namespace App\Repository;

use App\Entity\Line;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Line|null find($id, $lockMode = null, $lockVersion = null)
 * @method Line|null findOneBy(array $criteria, array $orderBy = null)
 * @method Line[]    findAll()
 * @method Line[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LineRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Line::class);
    }

    // /**
    //  * @return Line[] Returns an array of Line objects
    //  */

    public function selectAll($page = 1): Pagerfanta
    {
        $qb = $this->createQueryBuilder('l')
            ->select('l', 'destinationsBegin', 'destinationsEnd', 'addressCity', 'addressRegion', 'addressStreet', 'addressCityEnd', 'addressRegionEnd', 'addressStreetEnd')
            ->leftJoin('l.destinationsBegin', 'destinationsBegin')
            ->leftJoin('l.destinationsEnd', 'destinationsEnd')
            ->leftJoin('destinationsBegin.addressCity', 'addressCity')
            ->leftJoin('destinationsBegin.addressRegion', 'addressRegion')
            ->leftJoin('destinationsBegin.addressStreet', 'addressStreet')
            ->leftJoin('destinationsEnd.addressCity', 'addressCityEnd')
            ->leftJoin('destinationsEnd.addressRegion', 'addressRegionEnd')
            ->leftJoin('destinationsEnd.addressStreet', 'addressStreetEnd')
            ->orderBy('l.extId', 'ASC');

        return $this->createPaginator($qb->getQuery(), $page);
    }

    public function selectForDownloads($ids)
    {
        $qb = $this->createQueryBuilder('l')
            ->select('l', 'destinationsBegin', 'destinationsEnd', 'addressCity', 'addressRegion', 'addressStreet', 'addressCityEnd', 'addressRegionEnd', 'addressStreetEnd')
            ->leftJoin('l.destinationsBegin', 'destinationsBegin')
            ->leftJoin('l.destinationsEnd', 'destinationsEnd')
            ->leftJoin('destinationsBegin.addressCity', 'addressCity')
            ->leftJoin('destinationsBegin.addressRegion', 'addressRegion')
            ->leftJoin('destinationsBegin.addressStreet', 'addressStreet')
            ->leftJoin('destinationsEnd.addressCity', 'addressCityEnd')
            ->leftJoin('destinationsEnd.addressRegion', 'addressRegionEnd')
            ->leftJoin('destinationsEnd.addressStreet', 'addressStreetEnd')
            ->orderBy('l.extId', 'ASC');
        $qb->andWhere($qb->expr()->in('l.extId', ':ids'))->setParameter('ids', $ids);

        return $qb->getQuery()->getResult();
    }

    private function createPaginator(Query $query, int $page): Pagerfanta
    {
        $paginator = new Pagerfanta(new DoctrineORMAdapter($query));
        $paginator->setMaxPerPage(Line::NUM_ITEMS);
        $paginator->setCurrentPage($page);

        return $paginator;
    }

    /*
    public function findOneBySomeField($value): ?Canal
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
