<?php

namespace App\Repository;

use App\Entity\Reservations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReservationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservations::class);
    }

    public function findExistingReservation($vehicle, $startDate, $endDate)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.id_vehicle = :vehicle')
            ->andWhere('r.start_date <= :end_date')
            ->andWhere('r.end_date >= :start_date')
            ->setParameter('vehicle', $vehicle)
            ->setParameter('start_date', $startDate)
            ->setParameter('end_date', $endDate)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    public function findConflictingReservations(Reservations $reservation): array
    {
        $queryBuilder = $this->createQueryBuilder('r')
            ->where('r.id_vehicle = :id_vehicle')
            ->andWhere('r.start_date <= :end_date')
            ->andWhere('r.end_date >= :start_date')
            ->setParameter('id_vehicle', $reservation->getIdVehicle())
            ->setParameter('start_date', $reservation->getStartDate())
            ->setParameter('end_date', $reservation->getEndDate());
    
        // Exclure la réservation actuelle si elle est déjà persistée
        if ($reservation->getId() !== null) {
            $queryBuilder->andWhere('r.id <> :id')
                ->setParameter('id', $reservation->getId());
        }
    
        return $queryBuilder->getQuery()->getResult();
    }
}
