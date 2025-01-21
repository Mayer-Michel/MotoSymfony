<?php

namespace App\Controller;

use App\Entity\Bike;
use App\Repository\BikeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    /**
     * Méthode permettant d'afficher la page d'accueil avec toute les motos
     * @Route("/", name="app_home")
     * @param BikeRepository $bikeRepository
     * @return Response
     */
    #[Route('/', name: 'app_home')]
    public function index(BikeRepository $bikeRepository): Response
    {
         //on va déclarer une variable
         $title = "Nos Motos";

         //on recupère les datas de tous les jeux
         $bike = $bikeRepository->getBikeWithInfo();

        return $this->render('home/index.html.twig', [
            'title' => $title,
            'bikes' => $bike
        ]);
    }
}
