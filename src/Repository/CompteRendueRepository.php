<?php

namespace App\Repository;

use App\Entity\CompteRendue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CompteRendue|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompteRendue|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompteRendue[]    findAll()
 * @method CompteRendue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompteRendueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CompteRendue::class);
    }

    // /**
    //  * @return CompteRendue[] Returns an array of CompteRendue objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CompteRendue
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
