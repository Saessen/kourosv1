<?php

namespace App\Entity;

use App\Repository\PrixRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrixRepository::class)
 */
class Prix
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Formations::class, inversedBy="prixes")
     */
    private $prixJourFormation;

    /**
     * @ORM\ManyToMany(targetEntity=Devis::class, inversedBy="prixes")
     */
    private $nbrParticipants;

    /**
     * @ORM\Column(type="float")
     */
    private $prixHT;

    /**
     * @ORM\Column(type="float")
     */
    private $prixTTC;

    private $calculate;

    public function __construct()
    {
        $this->prixJourFormation = new ArrayCollection();
        $this->nbrParticipants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Formations[]
     */
    public function getPrixJourFormation(): Collection
    {
        return $this->prixJourFormation;
    }

    public function addPrixJourFormation(Formations $prixJourFormation): self
    {
        if (!$this->prixJourFormation->contains($prixJourFormation)) {
            $this->prixJourFormation[] = $prixJourFormation;
        }

        return $this;
    }

    public function removePrixJourFormation(Formations $prixJourFormation): self
    {
        $this->prixJourFormation->removeElement($prixJourFormation);

        return $this;
    }

    /**
     * @return Collection|Devis[]
     */
    public function getNbrParticipants(): Collection
    {
        return $this->nbrParticipants;
    }

    public function addNbrParticipant(Devis $nbrParticipant): self
    {
        if (!$this->nbrParticipants->contains($nbrParticipant)) {
            $this->nbrParticipants[] = $nbrParticipant;
        }

        return $this;
    }

    public function removeNbrParticipant(Devis $nbrParticipant): self
    {
        $this->nbrParticipants->removeElement($nbrParticipant);

        return $this;
    }

    public function getPrixHT(): ?float
    {
        return $this->prixHT;
    }

    public function setPrixHT(float $prixHT): self
    {
        $this->prixHT = $prixHT;

        return $this;
    }

    public function getPrixTTC(): ?float
    {
        return $this->prixTTC;
    }

    public function setPrixTTC(float $prixTTC): self
    {
        $this->prixTTC = $prixTTC;

        return $this;
    }
    public function calculate(int $prixJourFormation, int $nbrParticipant)
    {
        return $prixJourFormation * $nbrParticipant;
    }

    /**
     * Get the value of calculate
     */ 
    public function getCalculate()
    {
        return $this->calculate;
    }

    /**
     * Set the value of calculate
     *
     * @return  self
     */ 
    public function setCalculate($calculate)
    {
        $this->calculate = $calculate;

        return $this;
    }
    public function __toString(){
        return $this->id;
    }
}
// Objectif enregistrer le prix du devis en BDD 
