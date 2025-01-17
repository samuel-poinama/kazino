<?php

namespace App\Repository;

use App\Entity\Score;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Score>
 */
class ScoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Score::class);
    }


        public function findOneByUser($user): ?Score
        {
            $userId = $user->getId();
            return $this->createQueryBuilder('score')
                ->andWhere('score.user = :user')
                ->setParameter('user', $user)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        }


        public function getFirst($limit): array
        {
            return $this->createQueryBuilder('score')
            ->orderBy('score.points', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
        }
}
