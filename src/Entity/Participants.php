<?php

namespace App\Entity;

use App\Repository\ParticipantsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParticipantsRepository::class)
 */
class Participants
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="participants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entreprise;

    /**
     * @ORM\ManyToMany(targetEntity=Conventions::class, inversedBy="participants", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $conventions;

    /**
     * @ORM\ManyToMany(targetEntity=Devis::class, mappedBy="participants")
     */
    private $devis;

    public function __construct()
    {
        $this->devis = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getConventions(): ?Conventions
    {
        return $this->conventions;
    }

    public function setConventions(?Conventions $conventions): self
    {
        $this->conventions = $conventions;

        return $this;
    }

    /**
     * @return Collection|Devis[]
     */
    public function getDevis(): Collection
    {
        return $this->devis;
    }

    // public function addDevi(Devis $devi): self
    // {
    //     if (!$this->devis->contains($devi)) {
    //         $this->devis[] = $devi;
    //         $devi->addParticipant($this);
    //     }

    //     return $this;
    // }

    // public function removeDevi(Devis $devi): self
    // {
    //     if ($this->devis->removeElement($devi)) {
    //         $devi->removeParticipant($this);
    //     }

    //     return $this;
    // }
}
