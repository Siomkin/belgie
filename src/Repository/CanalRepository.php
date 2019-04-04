<?php

namespace App\Repository;

use App\Entity\Canal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Canal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Canal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Canal[]    findAll()
 * @method Canal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CanalRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Canal::class);
    }

    // /**
    //  * @return Canal[] Returns an array of Canal objects
    //  */

    public function selectAll($page = 1): Pagerfanta
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c', 'begin_equip', 'end_equip')
            ->leftJoin('c.beginEquip', 'begin_equip')
            ->leftJoin('c.endEquip', 'end_equip')
            ->orderBy('c.extId', 'ASC');

        return $this->createPaginator($qb->getQuery(), $page);
    }

    public function selectForDownloads($ids)
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c', 'beginEquip', 'endEquip', 'beginPorts', 'endPorts', 'lines')
            ->leftJoin('c.beginEquip', 'beginEquip')
            ->leftJoin('c.endEquip', 'endEquip')
            ->leftJoin('c.beginPorts', 'beginPorts')
            ->leftJoin('c.endPorts', 'endPorts')
            ->leftJoin('c.lines', 'lines')
            ->orderBy('c.extId', 'ASC');

        $qb->andWhere($qb->expr()->in('c.extId', ':ids'))->setParameter('ids', $ids);

        return $qb->getQuery()->getResult();
    }

    private function createPaginator(Query $query, int $page): Pagerfanta
    {
        $paginator = new Pagerfanta(new DoctrineORMAdapter($query));
        $paginator->setMaxPerPage(Canal::NUM_ITEMS);
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
