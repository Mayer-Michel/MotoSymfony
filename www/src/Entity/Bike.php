<?php

namespace App\Entity;

use App\Repository\BikeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BikeRepository::class)]
class Bike
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $releaseDate = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\ManyToOne(inversedBy: 'bikes')]
    private ?model $model_id = null;

    #[ORM\ManyToOne(inversedBy: 'bikes')]
    private ?brand $brand_id = null;

    #[ORM\ManyToOne(inversedBy: 'bikes')]
    private ?cylenders $cylenders_id = null;

    /**
     * @var Collection<int, places>
     */
    #[ORM\ManyToMany(targetEntity: places::class, inversedBy: 'bikes')]
    private Collection $places;

    /**
     * @var Collection<int, Image>
     */
    #[ORM\OneToMany(targetEntity: Image::class, mappedBy: 'bike_id')]
    private Collection $images;

    public function __construct()
    {
        $this->places = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getModelId(): ?model
    {
        return $this->model_id;
    }

    public function setModelId(?model $model_id): static
    {
        $this->model_id = $model_id;

        return $this;
    }

    public function getBrandId(): ?brand
    {
        return $this->brand_id;
    }

    public function setBrandId(?brand $brand_id): static
    {
        $this->brand_id = $brand_id;

        return $this;
    }

    public function getCylendersId(): ?cylenders
    {
        return $this->cylenders_id;
    }

    public function setCylendersId(?cylenders $cylenders_id): static
    {
        $this->cylenders_id = $cylenders_id;

        return $this;
    }

    /**
     * @return Collection<int, places>
     */
    public function getPlaces(): Collection
    {
        return $this->places;
    }

    public function addPlace(places $place): static
    {
        if (!$this->places->contains($place)) {
            $this->places->add($place);
        }

        return $this;
    }

    public function removePlace(places $place): static
    {
        $this->places->removeElement($place);

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
            $image->setBikeId($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getBikeId() === $this) {
                $image->setBikeId(null);
            }
        }

        return $this;
    }
}
