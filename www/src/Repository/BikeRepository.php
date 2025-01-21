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
            'b.releaseDate',
            'b.description',
            'b.price',
            'm.modelName',
            'br.brandName',
            'c.CC',
            'p.nbr',
            'i.imagePath',
        ])->from(Bike::class, 'b')
        ->join('b.model_id', 'm')
        ->join('b.brand_id', 'br')
        ->join('b.cylenders_id', 'c')
        ->join('b.places', 'p')
        ->join('b.images', 'i')
        ->getQuery();

        return $query->getResult();
    }
}
