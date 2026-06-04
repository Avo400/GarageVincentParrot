<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: AvisRepository::class)]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[ORM\ManyToOne]
    private ?User $user = null;
    

    #[ORM\Column]
    #[Assert\Positive]
    private ?int $note = null;

    #[ORM\Column(length: 255)]
    #[Assert\Regex('/^\w+/')]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\Regex('/^\w+/')]

    private ?string $contenuMessageAvis = null;

    #[ORM\Column]
    private ?bool $approved = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenuMessageAvis(): ?string
    {
        return $this->contenuMessageAvis;
    }

    public function setContenuMessageAvis(string $contenuMessageAvis): static
    {
        $this->contenuMessageAvis = $contenuMessageAvis;

        return $this;
    }
  /*   public function getUser(): ?User {
        return $this->user;
    }

    public function setUser(?User $user): ?User {
        $this->user = $user;
    } */
    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function isApproved(): ?bool
    {
        return $this->approved;
    }

    public function setApproved(bool $approved): static
    {
        $this->approved = $approved;

        return $this;
    }
}
