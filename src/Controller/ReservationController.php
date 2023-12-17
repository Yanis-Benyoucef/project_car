<?php

namespace App\Controller;

use App\Entity\Reservations;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'reservation')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $reservation = new Reservations();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $conflicts = $em->getRepository(Reservations::class)->findConflictingReservations($reservation);

            if (count($conflicts) > 0) {
                $this->addFlash('error', 'Les dates sélectionnées sont déjà réservées.');
            } else {
                $em->persist($reservation);
                $em->flush();

                $this->addFlash('success', 'La réservation a été effectuée avec succès.');
            }
        }

        return $this->render('reservation/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
