<?php

namespace App\Entity;

use App\Repository\ReservationsRepository;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationsRepository::class)]
class Reservations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    public ?\DateTimeInterface $start_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    public ?\DateTimeInterface $end_date = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Vehicle $id_vehicle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): static
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): static
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getIdVehicle(): ?Vehicle
    {
        return $this->id_vehicle;
    }

    public function setIdVehicle(?Vehicle $id_vehicle): static
    {
        $this->id_vehicle = $id_vehicle;

        return $this;
    }

    public function validateDatesAndAge(ExecutionContextInterface $context): void
    {
        $startDate = $this->start_date;
        $endDate = $this->end_date;

        // Ajoutez votre logique de validation personnalisée pour les dates ici

        // Vérifier si l'âge est d'au moins 18 ans
        $age = $this->age;

        if ($age < 18) {
            $context->buildViolation('L\'âge doit être d\'au moins 18 ans.')
                ->atPath('age')
                ->addViolation();
        }
    }
}
