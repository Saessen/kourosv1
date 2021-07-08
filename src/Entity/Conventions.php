<?php

namespace App\Entity;

use App\Repository\ConventionsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConventionsRepository::class)
 */
class Conventions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Prospects::class, inversedBy="conventions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $prospect;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $lieuFormation;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nomParticipants;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $prenomParticipants;

    /**
     * @ORM\OneToOne(targetEntity=Devis::class, inversedBy="conventions", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $devis;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProspect(): ?Prospects
    {
        return $this->prospect;
    }

    public function setProspect(?Prospects $prospect): self
    {
        $this->prospect = $prospect;

        return $this;
    }

    public function getLieuFormation(): ?string
    {
        return $this->lieuFormation;
    }

    public function setLieuFormation(?string $lieuFormation): self
    {
        $this->lieuFormation = $lieuFormation;

        return $this;
    }

    public function getNomParticipants(): ?string
    {
        return $this->nomParticipants;
    }

    public function setNomParticipants(string $nomParticipants): self
    {
        $this->nomParticipants = $nomParticipants;

        return $this;
    }

    public function getPrenomParticipants(): ?string
    {
        return $this->prenomParticipants;
    }

    public function setPrenomParticipants(?string $prenomParticipants): self
    {
        $this->prenomParticipants = $prenomParticipants;

        return $this;
    }

    public function getDevis(): ?Devis
    {
        return $this->devis;
    }

    public function setDevis(Devis $devis): self
    {
        $this->devis = $devis;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }
}
