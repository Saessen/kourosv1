<?php

namespace App\Entity;

use App\Repository\DevisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DevisRepository::class)
 */
class Devis
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Formations::class, inversedBy="devis")
     */
    private $formations;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrParticipants;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tva;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\ManyToOne(targetEntity=Prospects::class, inversedBy="devis")
     */
    private $client;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateFin;

    /**
     * @ORM\Column(type="integer")
     */
    private $dureeH;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroDevis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $methode;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $fraisAnnexes;

    /**
     * @ORM\ManyToOne(targetEntity=Opco::class, inversedBy="devis")
     */
    private $opco;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @ORM\OneToOne(targetEntity=Conventions::class, mappedBy="devis", cascade={"persist", "remove"})
     */
    private $conventions;

    public function __construct()
    {
        $this->formations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Formations[]
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formations $formation): self
    {
        if (!$this->formations->contains($formation)) {
            $this->formations[] = $formation;
        }

        return $this;
    }

    public function removeFormation(Formations $formation): self
    {
        $this->formations->removeElement($formation);

        return $this;
    }

    public function getNbrParticipants(): ?int
    {
        return $this->nbrParticipants;
    }

    public function setNbrParticipants(int $nbrParticipants): self
    {
        $this->nbrParticipants = $nbrParticipants;

        return $this;
    }

    public function getTarif(): ?float
    {
        return $this->tarif;
    }

    public function setTarif(float $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getTva(): ?float
    {
        return $this->tva;
    }

    public function setTva(?float $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getClient(): ?Prospects
    {
        return $this->client;
    }

    public function setClient(?Prospects $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getDureeH(): ?int
    {
        return $this->dureeH;
    }

    public function setDureeH(int $dureeH): self
    {
        $this->dureeH = $dureeH;

        return $this;
    }

    public function getNumeroDevis(): ?int
    {
        return $this->numeroDevis;
    }

    public function setNumeroDevis(int $numeroDevis): self
    {
        $this->numeroDevis = $numeroDevis;

        return $this;
    }

    public function getMethode(): ?string
    {
        return $this->methode;
    }

    public function setMethode(string $methode): self
    {
        $this->methode = $methode;

        return $this;
    }

    public function getFraisAnnexes(): ?float
    {
        return $this->fraisAnnexes;
    }

    public function setFraisAnnexes(?float $fraisAnnexes): self
    {
        $this->fraisAnnexes = $fraisAnnexes;

        return $this;
    }

    public function getOpco(): ?Opco
    {
        return $this->opco;
    }

    public function setOpco(?Opco $opco): self
    {
        $this->opco = $opco;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }
    public function __toString(){
        return $this->id;
    }

    public function getConventions(): ?Conventions
    {
        return $this->conventions;
    }

    public function setConventions(Conventions $conventions): self
    {
        // set the owning side of the relation if necessary
        if ($conventions->getDevis() !== $this) {
            $conventions->setDevis($this);
        }

        $this->conventions = $conventions;

        return $this;
    }
}
