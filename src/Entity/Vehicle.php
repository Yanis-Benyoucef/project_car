<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 4)]
    private ?string $year = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'id_vehicle', targetEntity: Image::class)]
    private Collection $images;

    #[ORM\ManyToOne(inversedBy: 'vehicles')]
    public ?Fuel $fuel_type = null;

    #[ORM\ManyToOne(inversedBy: 'vehicles')]
    private ?Model $model = null;

    #[ORM\OneToMany(mappedBy: 'id_vehicle', targetEntity: Reservations::class)]
    private Collection $reservations;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): static
    {
        $this->year = $year;

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

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setIdVehicle($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getIdVehicle() === $this) {
                $image->setIdVehicle(null);
            }
        }

        return $this;
    }

    public function getFuelType(): ?Fuel
    {
        return $this->fuel_type;
    }

    public function setFuelType(?Fuel $fuel_type): static
    {
        $this->fuel_type = $fuel_type;

        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): static
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @return Collection<int, Reservations>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservations $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setIdVehicle($this);
        }

        return $this;
    }

    public function removeReservation(Reservations $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getIdVehicle() === $this) {
                $reservation->setIdVehicle(null);
            }
        }

        return $this;
    }
}
