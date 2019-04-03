<?php

namespace App\Repository;

use App\Entity\Equipment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Equipment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Equipment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Equipment[]    findAll()
 * @method Equipment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquipmentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Equipment::class);
    }

    // /**
    //  * @return Equipment[] Returns an array of Equipment objects
    //  */

    public function selectAll($page = 1): Pagerfanta
    {
        $qb = $this->createQueryBuilder('e')
            ->select('e', 'destinations', 'type', 'addressCity', 'addressRegion', 'addressStreet')
            ->leftJoin('e.destinations', 'destinations')
            ->leftJoin('e.type', 'type')
            ->leftJoin('destinations.addressCity', 'addressCity')
            ->leftJoin('destinations.addressRegion', 'addressRegion')
            ->leftJoin('destinations.addressStreet', 'addressStreet')
            ->orderBy('e.extId', 'ASC');

        return $this->createPaginator($qb->getQuery(), $page);
    }

    private function createPaginator(Query $query, int $page): Pagerfanta
    {
        $paginator = new Pagerfanta(new DoctrineORMAdapter($query));
        $paginator->setMaxPerPage(Equipment::NUM_ITEMS);
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
