<?php

namespace App\Entity;

use App\Repository\ConventionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToOne(targetEntity=Devis::class, inversedBy="conventions", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $devis;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToMany(targetEntity=Participants::class, inversedBy="conventions", cascade={"persist", "remove"})
     */
    private $participants;


    //     /**
    //  * @ORM\Column(type="string", length=255, nullable="true")
    //  */
    // private $entrepriseName;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
    }

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

    // public function getEntrepriseName(): ?string
    // {
    //     return $this->entrepriseName;
    // }

    // public function setEntrepriseName(string $entrepriseName): self
    // {
    //     $this->entrepriseName = $entrepriseName;

    //     return $this;
    // }

    /**
     * @return Collection|Participants[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(Participants $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
        }

        return $this;
    }

    public function removeParticipant(Participants $participant): self
    {
        $this->participants->removeElement($participant);

        return $this;
    }
}
