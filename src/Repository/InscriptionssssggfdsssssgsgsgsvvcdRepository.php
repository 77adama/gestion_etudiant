<?php

namespace App\Repository;

use App\Entity\Inscriptionssssggfdsssssgsgsgsvvcd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Inscriptionssssggfdsssssgsgsgsvvcd>
 *
 * @method Inscriptionssssggfdsssssgsgsgsvvcd|null find($id, $lockMode = null, $lockVersion = null)
 * @method Inscriptionssssggfdsssssgsgsgsvvcd|null findOneBy(array $criteria, array $orderBy = null)
 * @method Inscriptionssssggfdsssssgsgsgsvvcd[]    findAll()
 * @method Inscriptionssssggfdsssssgsgsgsvvcd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InscriptionssssggfdsssssgsgsgsvvcdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Inscriptionssssggfdsssssgsgsgsvvcd::class);
    }

    public function add(Inscriptionssssggfdsssssgsgsgsvvcd $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Inscriptionssssggfdsssssgsgsgsvvcd $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Inscriptionssssggfdsssssgsgsgsvvcd[] Returns an array of Inscriptionssssggfdsssssgsgsgsvvcd objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Inscriptionssssggfdsssssgsgsgsvvcd
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
