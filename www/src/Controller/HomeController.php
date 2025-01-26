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

    /**
     * Méthode qui retourne la liste des motos par brand
     * @Route("/brand/{id}", name="app_brand")
     * @param BikeRepository $bikeRepository
     * @param int $id
     * @return Response
     */
    #[Route('/brand/{id}', name: 'app_brand')]
    public function gamesByConsole(BikeRepository $bikeRepository, int $id):Response
    {
        //on recupere les jeux filtré par consoles : $games
        $bikes = $bikeRepository->getBikeByBrand($id);
        //on definit le titre avec le nom de la console : $title
        $title ='Our bikes: ' . $bikes[0]['brandName'];
       
        

        return $this->render('home/index.html.twig', [
            'bikes' => $bikes,
            'title' => $title
        ]);
    }

    #[Route('/detail/{id}', name: 'app_detail')]
    public function bikeDetail(BikeRepository $bikeRepository, int $id):Response
    {
        //on recupere les jeux filtré par consoles : $games
        $bike = $bikeRepository->getBikeDetails($id);

        $images = $bikeRepository->getImagesByBike($id);

        return $this->render('home/detail.html.twig', [
            'bike' => $bike,
            'images' => $images
        ]);
    }
   
}
