<?php

namespace App\Controller;

use App\Repository\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IndexController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(VehicleRepository $vehicleRepository): Response
    {
        $vehicles = $vehicleRepository->findAllWithImages();

        return $this->render('index/index.html.twig', [
            'vehicles' => $vehicles,
        ]);
    }
}