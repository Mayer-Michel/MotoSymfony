<?php

namespace App\Entity;

use App\Repository\CylenderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CylenderRepository::class)]
class Cylender
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $cylenders = null;

    /**
     * @var Collection<int, Bike>
     */
    #[ORM\OneToMany(targetEntity: Bike::class, mappedBy: 'cylender')]
    private Collection $bikes;

    public function __construct()
    {
        $this->bikes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCylenders(): ?int
    {
        return $this->cylenders;
    }

    public function setCylenders(int $cylenders): static
    {
        $this->cylenders = $cylenders;

        return $this;
    }

    /**
     * @return Collection<int, Bike>
     */
    public function getBikes(): Collection
    {
        return $this->bikes;
    }

    public function addBike(Bike $bike): static
    {
        if (!$this->bikes->contains($bike)) {
            $this->bikes->add($bike);
            $bike->setCylender($this);
        }

        return $this;
    }

    public function removeBike(Bike $bike): static
    {
        if ($this->bikes->removeElement($bike)) {
            // set the owning side to null (unless already changed)
            if ($bike->getCylender() === $this) {
                $bike->setCylender(null);
            }
        }

        return $this;
    }
}
