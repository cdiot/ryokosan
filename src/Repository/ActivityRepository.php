<?php

namespace App\Repository;

use App\Entity\Activity;
use App\Service\ActivitySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Activity>
 *
 * @method Activity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activity[]    findAll()
 * @method Activity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activity::class);
    }

    public function add(Activity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Activity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAll()
    {
        return $this->findBy([], ['createdAt' => 'DESC']);
    }

    /**
     * Used to count all created activities.
     */
    public function countAllActivity()
    {
        return $this->createQueryBuilder('a')
            ->select('COUNT(a.id) as value')
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Retrieve activities based on user research
     * @param ActivitySearch $search
     * @return Activity[]
     */
    public function findBySearch(ActivitySearch $search)
    {
        $query = $this
            ->createQueryBuilder('a')
            ->select('u', 'a')
            ->join('a.user', 'u');
        if ($search->getDestinations()->count() > 0) {
            $key = 0;
            foreach ($search->getDestinations() as $destination) {
                $key++;
                $query = $query
                    ->andWhere(":destination$key MEMBER OF a.destinations")
                    ->setParameter("destination$key", $destination);
            }
        }
        if ($search->getMinAge()) {
            $query = $query
                ->andWhere('u.birthday <= :minAge')
                ->setParameter('minAge', $search->getMinAge());
        }
        if ($search->getMaxAge()) {
            $query = $query
                ->andWhere('u.birthday >= :maxAge')
                ->setParameter('maxAge', $search->getMaxAge());
        }
        if ($search->getStartDate()) {
            $query = $query
                ->andWhere('a.startDate >= :startDate')
                ->setParameter('startDate', $search->getStartDate());
        }
        if ($search->getGender()) {
            $query = $query
                ->andWhere('u.gender = :gender')
                ->setParameter('gender', $search->getGender());
        }
        return $query->getQuery()->getResult();
    }

    //    /**
    //     * @return Activity[] Returns an array of Activity objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Activity
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
