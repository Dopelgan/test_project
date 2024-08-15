<?php

namespace App\Repository;

use App\Entity\Blog;
use App\Entity\User;
use App\Filter\BlogFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Blog>
 */
class BlogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Blog::class);
    }

    public function getBlogs()
    {
        return $this
            ->createQueryBuilder('b')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    public function FindByBlogFilter(BlogFilter $blogFilter)
    {
        $blogs = $this->createQueryBuilder('b')
            ->leftJoin(User::class, 'u', 'WITH', 'u.id = b.user')
            ->orderBy('b.id');

        if ($blogFilter->getUser()){
            $blogs
                ->where('b.user = :user')
                ->setParameter('user', $blogFilter->getUser());
        }

        if ($blogFilter->getTitle()){
            $blogs
                ->where('b.title LIKE :title')
                ->setParameter('title', '%'.$blogFilter->getTitle().'%');
        }

//        dd($blogs->getQuery()->getSQL());

        return $blogs;
    }
}
