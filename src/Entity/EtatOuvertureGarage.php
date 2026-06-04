<?php

namespace App\Entity;

use App\Repository\EtatOuvertureGarageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtatOuvertureGarageRepository::class)]
class EtatOuvertureGarage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $isOpen = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsOpen(): ?bool
    {
        return $this->isOpen;
    }

    public function setIsOpen(bool $isOpen): static
    {
        $this->isOpen = $isOpen;

        return $this;
    }
}
