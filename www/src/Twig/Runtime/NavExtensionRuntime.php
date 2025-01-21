<?php

namespace App\Twig\Runtime;

use App\Repository\BikeRepository;
use Twig\Extension\RuntimeExtensionInterface;

class NavExtensionRuntime implements RuntimeExtensionInterface
{
    //on va déclarer une variable en private pour stocker l'instance de gameRepository
    private $bikeRepository;

    public function __construct(BikeRepository $bikeRepository)
    {
       $this->bikeRepository = $bikeRepository;
    }

    public function menuItems()
    {
        return $this->bikeRepository->getCountBikeByBrand();
    }

    public function menuItemsAge()
    {
        return $this->bikeRepository->getCountBikeByCylenders();
    }

    public function filtersItems()
    {
        return [
            ['label' => 'Prix', 'filter' => 'g.price ASC', 'icon' => 'fa-sharp fa-solid fa-arrow-up'],
            ['label' => 'Prix', 'filter' => 'g.price DESC', 'icon' => 'fa-sharp fa-solid fa-arrow-down'],
            ['label' => 'Date de sortie', 'filter' => 'g.releaseDate ASC', 'icon' => 'fa-sharp fa-solid fa-arrow-up'],
            ['label' => 'Date de sortie', 'filter' => 'g.releaseDate DESC', 'icon' => 'fa-sharp fa-solid fa-arrow-down'],
            ['label' => 'Note presse', 'filter' => 'n.mediaNote ASC', 'icon' => 'fa-sharp fa-solid fa-arrow-up'],
            ['label' => 'Note presse', 'filter' => 'n.mediaNote DESC', 'icon' => 'fa-sharp fa-solid fa-arrow-down'],
            ['label' => 'Note utilisateur', 'filter' => 'n.userNote ASC', 'icon' => 'fa-sharp fa-solid fa-arrow-up'],
            ['label' => 'Note utilisateur', 'filter' => 'n.userNote DESC', 'icon' => 'fa-sharp fa-solid fa-arrow-down'],
        ];
    }

    public function numberFormat($number, $decimals = 2, $decPoint = '.', $thousandsSep = ',')
    {
        if ($number != 0) {
            return number_format($number, $decimals, $thousandsSep, $decPoint) . '€';
        } else {
            return 'GRATUIT';
        }
        
    }

    public function badgeUser($roles)
    {
        foreach ($roles as $role) {
            switch ($role){
                case 'ROLE_ADMIN':
                    return '<span class="badge text-bg-warning">Admin</span>';
                case 'ROLE_USER':
                    return '<span class="badge text-bg-primary">Client</span>';
                default:
                    return '<span class="badge text-bg-secondary">Inconnu</span>';
            }
        }
    }

}
