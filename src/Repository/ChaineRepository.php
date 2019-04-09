<?php

namespace App\Repository;

use App\Entity\Chaine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Chaine|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chaine|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chaine[]    findAll()
 * @method Chaine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChaineRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Chaine::class);
    }

    // /**
    //  * @return Chaine[] Returns an array of Chaine objects
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
    public function findOneBySomeField($value): ?Chaine
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
