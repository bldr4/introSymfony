<?php

namespace App\Repository;

use App\Entity\Posts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Posts>
 */
class PostsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Posts::class);
    }

    public function findPublished(): array
    {
        return $this->createQueryBuilder("p")
        ->andWhere('p.state = :state')
        ->setParameter('state', 'STATE_PUBLISHED')
        ->orderBy('p.createdAt', 'DESC')
        ->getQuery()
        ->getResult();
    }
}
