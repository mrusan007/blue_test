<?php

namespace App\Repository;

use App\Entity\Meals;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Meals|null find($id, $lockMode = null, $lockVersion = null)
 * @method Meals|null findOneBy(array $criteria, array $orderBy = null)
 * @method Meals[]    findAll()
 * @method Meals[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MealsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Meals::class);
    }

    // /**
    //  * @return Meals[] Returns an array of Meals objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Meals
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findCategoryInt(int $id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\Meals c
            WHERE c.category = :id
            ORDER BY c.title ASC'
        )->setParameter('id', $id);

        // returns an array of Product objects
        return $query->getResult();
    }

    public function findCategoryNotNull(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM meals m
            WHERE m.category_id is not null
            ORDER BY m.title ASC
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAllAssociative();
    }

    public function findCategoryNull(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM meals m
            WHERE m.category_id is null
            ORDER BY m.title ASC
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAllAssociative();
    }
}
