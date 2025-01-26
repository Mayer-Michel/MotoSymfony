<?php

namespace App\Repository;

use App\Entity\Bike;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bike>
 */
class BikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bike::class);
    }

    /**
     * Méthode qui récupère une moto par son id avec les images associées, les places, le modèle, la marque et le nombre de cylindres
     * @param int $id
     * return array
     */
    public function getBikeWithInfo(): array
    {
        //on appel l'entity manager
        $entityManager = $this->getEntityManager();
        //on crée une requête DQL
        $qb = $entityManager->createQueryBuilder();
        //on crée la requête
        $query = $qb->select([
            'b.id',
            'b.price',
            'm.modelName',
            'br.brandName',
            'i.imagePath',
        ])->from(Bike::class, 'b')
        ->join('b.model_id', 'm')
        ->join('b.brand_id', 'br')
        ->join('b.images', 'i')
        ->getQuery();

        return $query->getResult();
    }

    public function getImagesByBike(int $id)
    {
        $entityManager = $this->getEntityManager();

        $qb = $entityManager->createQueryBuilder();

        $query = $qb->select([
            'b.id',
            'i.imagePath'
        ])->from(Bike::class, 'b')
        ->join('b.images', 'i')
        ->where('b.id = :id')
        ->setParameter('id', $id)
        ->getQuery();

        return $query->getResult();
    }

    /**
     * Méthode qui retourne la liste des marques avec le nombre de motos associés
     * @return array
     */
    public function getCountBikeByBrand(): array
    {
        $entityManager = $this->getEntityManager();

        $qb = $entityManager->createQueryBuilder();

        $query = $qb->select([
            'br.id',
            'br.brandName',
            'COUNT(b.id) as nbr'
        ])->from(Bike::class, 'b')
        ->join('b.brand_id', 'br')
        ->groupBy('br.id')
        ->getQuery();

        return $query->getResult();
    }

    /**
     * Méthode qui retourne la liste des cylenders avec le nombre de motos associés
     * @return array
     */
    public function getCountBikeByCylenders(): array
    {
        $entityManager = $this->getEntityManager();

        $qb = $entityManager->createQueryBuilder();

        $query = $qb->select([
            'c.id',
            'c.CC',
            'COUNT(b.id) as nbr'
        ])->from(Bike::class, 'b')
        ->join('b.cylenders_id', 'c')
        ->groupBy('c.id')
        ->getQuery();

        return $query->getResult();
    }

    /**
     * Méthode qui récupère les motos par marque
     * @param int $id
     * @return array
     */
    public function getBikeByBrand(int $id): array
    {
        $entityManager = $this->getEntityManager();

        $qb = $entityManager->createQueryBuilder();

        $query = $qb->select([
            'b.id',
            'b.releaseDate',
            'b.description',
            'b.price',
            'br.brandName',
            'm.modelName',
            'c.CC'
            ])->from(Bike::class, 'b')
            ->join('b.brand_id', 'br')
            ->join('b.model_id', 'm')
            ->join('b.cylenders_id', 'c')
            ->where('br.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

            return $query->getResult();
    }

    /**
     * Méthode qui récupère une moto par son id avec les images associées, les places, le modèle, la marque, le nombre de cylindres, description, prix et date de sortie
     * @param int $id
     * @return array
     */
    public function getBikeDetails(int $id): array
    {
        $entityManager = $this->getEntityManager();

        $qb = $entityManager->createQueryBuilder();

        $query = $qb->select([
            'b.id',
            'b.releaseDate',
            'b.description',
            'b.price',
            'br.brandName',
            'm.modelName',
            'c.CC',
        ])->from(Bike::class, 'b')
        ->join('b.brand_id', 'br')
        ->join('b.model_id', 'm')
        ->join('b.cylenders_id', 'c')
        ->where('b.id = :id')
        ->setParameter('id', $id)
        ->getQuery();

        return $query->getResult();
    }

}
