<?php

namespace App\Entity;

use App\Repository\EtatDemandeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtatDemandeRepository::class)]
class EtatDemande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelleEtatDemande = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleEtatDemande(): ?string
    {
        return $this->libelleEtatDemande;
    }

    public function setLibelleEtatDemande(string $libelleEtatDemande): static
    {
        $this->libelleEtatDemande = $libelleEtatDemande;

        return $this;
    }

    public function __toString() {
        return $this->libelleEtatDemande;
    }
}
