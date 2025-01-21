<?php

namespace App\Entity;

use App\Repository\CylendersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CylendersRepository::class)]
class Cylenders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $CC = null;

    /**
     * @var Collection<int, Bike>
     */
    #[ORM\OneToMany(targetEntity: Bike::class, mappedBy: 'cylenders_id')]
    private Collection $bikes;

    public function __construct()
    {
        $this->bikes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCC(): ?int
    {
        return $this->CC;
    }

    public function setCC(int $CC): static
    {
        $this->CC = $CC;

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
            $bike->setCylendersId($this);
        }

        return $this;
    }

    public function removeBike(Bike $bike): static
    {
        if ($this->bikes->removeElement($bike)) {
            // set the owning side to null (unless already changed)
            if ($bike->getCylendersId() === $this) {
                $bike->setCylendersId(null);
            }
        }

        return $this;
    }
}
