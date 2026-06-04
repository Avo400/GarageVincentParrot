<?php

namespace App\Entity;

use App\Repository\DemandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeRepository::class)]
class Demande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\ManyToOne]
    private ?Vehicule $vehicule = null;

    #[ORM\ManyToOne]
    private ?EtatDemande $etatDemande = null;

    #[ORM\Column(length: 255)]
    private ?string $sujet = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contenuMessage = null;

    #[ORM\ManyToOne(inversedBy: 'demandes')]
    private ?GenreDemande $genreDemande = null;

    


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getVehicule(): ?vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(?vehicule $vehicule): static
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    public function getEtatDemande(): ?etatDemande
    {
        return $this->etatDemande;
    }

    public function setEtatDemande(?etatDemande $etatDemande): static
    {
        $this->etatDemande = $etatDemande;

        return $this;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): static
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getContenuMessage(): ?string
    {
        return $this->contenuMessage;
    }

    public function setContenuMessage(string $contenuMessage): static
    {
        $this->contenuMessage = $contenuMessage;

        return $this;
    }

    public function getGenreDemande(): ?GenreDemande
    {
        return $this->genreDemande;
    }

    public function setGenreDemande(?GenreDemande $genreDemande): static
    {
        $this->genreDemande = $genreDemande;

        return $this;
    }

    

}
