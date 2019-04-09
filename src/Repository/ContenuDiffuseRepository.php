<?php

namespace App\Repository;

use App\Entity\ContenuDiffuse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ContenuDiffuse|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContenuDiffuse|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContenuDiffuse[]    findAll()
 * @method ContenuDiffuse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContenuDiffuseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ContenuDiffuse::class);
    }

    // /**
    //  * @return ContenuDiffuse[] Returns an array of ContenuDiffuse objects
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
    public function findOneBySomeField($value): ?ContenuDiffuse
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
