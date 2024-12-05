<?php

namespace App\Repository;

use App\Entity\Posts;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Posts>
 */
class PostsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Posts::class);
    }

    public function findPublished(int $page, PaginatorInterface $paginator): PaginationInterface
    {
        $data = $this->createQueryBuilder("p")
        ->andWhere('p.state = :state')
        ->setParameter('state', 'STATE_PUBLISHED')
        ->orderBy('p.createdAt', 'DESC')
        ->getQuery()
        ->getResult();


        $posts = $paginator->paginate($data, $page, 10);
        return $posts;
    }
}
