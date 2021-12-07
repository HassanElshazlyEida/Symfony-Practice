<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    // // /**
    // //  * @return Post[] Returns an array of Post objects
    // //  */
    // /*
    public function findByExampleField($value=null)
    {
        $db=$this->createQueryBuilder('p');
        
        $db
            // ->andWhere('p.exampleField = :val')
            // ->setParameter('val', $value)
            // ->orderBy('p.id', 'ASC')
            // ->setMaxResults(10)
            ->innerJoin("App\Entity\Category",'c',Join::WITH,"c = p.category")
            ->select('p.title')
            ->where(
               $db->expr()->andX(
                $db->expr()->like("c.slug",":slug")
               )
            )
            ->setParameter("slug","asdasd")
        ;
        dd($db->getQuery()->getResult());
        return $db->getQuery()
        ->getResult();
    }
    // */

    /*
    public function findOneBySomeField($value): ?Post
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
