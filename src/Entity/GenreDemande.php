<?php

namespace App\Entity;

use App\Repository\GenreDemandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenreDemandeRepository::class)]
class GenreDemande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelleGenreDemande = null;

    #[ORM\OneToMany(mappedBy: 'genreDemande', targetEntity: Demande::class)]
    private Collection $demandes;

    public function __construct()
    {
        $this->demandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleGenreDemande(): ?string
    {
        return $this->libelleGenreDemande;
    }

    public function setLibelleGenreDemande(string $libelleGenreDemande): static
    {
        $this->libelleGenreDemande = $libelleGenreDemande;

        return $this;
    }

    /**
     * @return Collection<int, Demande>
     */
    public function getDemandes(): Collection
    {
        return $this->demandes;
    }

    public function addDemande(Demande $demande): static
    {
        if (!$this->demandes->contains($demande)) {
            $this->demandes->add($demande);
            $demande->setGenreDemande($this);
        }

        return $this;
    }

    public function removeDemande(Demande $demande): static
    {
        if ($this->demandes->removeElement($demande)) {
            // set the owning side to null (unless already changed)
            if ($demande->getGenreDemande() === $this) {
                $demande->setGenreDemande(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return $this->libelleGenreDemande;
    }
}
