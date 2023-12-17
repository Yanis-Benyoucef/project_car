<?php

namespace App\Controller;

use App\Entity\Vehicle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VehicleController extends AbstractController
{
    #[Route('/vehicle/{id}', name: 'vehicle_show')]
    public function show(Vehicle $vehicle): Response
    {
        return $this->render('vehicle/show.html.twig', [
            'vehicle' => $vehicle,
        ]);
    }
}
