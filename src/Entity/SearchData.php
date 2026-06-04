<?php

namespace App\Entity;

use App\Repository\SearchDataRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SearchDataRepository::class)]
class SearchData
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $minPrice = null;

    #[ORM\Column]
    private ?int $maxPrice = null;

    #[ORM\Column]
    private ?int $minKms = null;

    #[ORM\Column]
    private ?int $maxKms = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $minAnnees = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $maxAnnees = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMinPrice(): ?int
    {
        return $this->minPrice;
    }

    public function setMinPrice(int $minPrice): static
    {
        $this->minPrice = $minPrice;

        return $this;
    }

    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    public function setMaxPrice(int $maxPrice): static
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    public function getMinKms(): ?int
    {
        return $this->minKms;
    }

    public function setMinKms(int $minKms): static
    {
        $this->minKms = $minKms;

        return $this;
    }

    public function getMaxKms(): ?int
    {
        return $this->maxKms;
    }

    public function setMaxKms(int $maxKms): static
    {
        $this->maxKms = $maxKms;

        return $this;
    }

    public function getMinAnnees(): ?\DateTimeInterface
    {
        return $this->minAnnees;
    }

    public function setMinAnnees(\DateTimeInterface $minAnnees): static
    {
        $this->minAnnees = $minAnnees;

        return $this;
    }

    public function getMaxAnnees(): ?\DateTimeInterface
    {
        return $this->maxAnnees;
    }

    public function setMaxAnnees(\DateTimeInterface $maxAnnees): static
    {
        $this->maxAnnees = $maxAnnees;

        return $this;
    }
}
