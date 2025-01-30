<?php

namespace App\Repository;

use App\Entity\Worker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Worker>
 */
class WorkerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Worker::class);
    }

    public function findByUserId(int $userId): array
    {
        return $this->createQueryBuilder('worker')
            ->andWhere('worker.User = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult();
    }
}
