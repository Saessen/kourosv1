<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $denominationSociale;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $siren;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $nomFacultatif;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $prenomFacultatif;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $mailFacultatif;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $telFacultatif;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $activite;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\OneToMany(targetEntity=Prospects::class, mappedBy="entreprise")
     */
    private $prospects;

    /**
     * @ORM\OneToMany(targetEntity=Participants::class, mappedBy="entreprise")
     */
    private $participants;

    

    public function __construct()
    {
        $this->prospects = new ArrayCollection();
        $this->clients = new ArrayCollection();
        $this->clientsActivite = new ArrayCollection();
        $this->participants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDenominationSociale(): ?string
    {
        return $this->denominationSociale;
    }

    public function setDenominationSociale(string $denominationSociale): self
    {
        $this->denominationSociale = $denominationSociale;

        return $this;
    }

    public function getSiren(): ?int
    {
        return $this->siren;
    }

    public function setSiren(?int $siren): self
    {
        $this->siren = $siren;

        return $this;
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

    public function getNomFacultatif(): ?string
    {
        return $this->nomFacultatif;
    }

    public function setNomFacultatif(?string $nomFacultatif): self
    {
        $this->nomFacultatif = $nomFacultatif;

        return $this;
    }

    public function getPrenomFacultatif(): ?string
    {
        return $this->prenomFacultatif;
    }

    public function setPrenomFacultatif(?string $prenomFacultatif): self
    {
        $this->prenomFacultatif = $prenomFacultatif;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getMailFacultatif(): ?string
    {
        return $this->mailFacultatif;
    }

    public function setMailFacultatif(?string $mailFacultatif): self
    {
        $this->mailFacultatif = $mailFacultatif;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getTelFacultatif(): ?string
    {
        return $this->telFacultatif;
    }

    public function setTelFacultatif(?string $telFacultatif): self
    {
        $this->telFacultatif = $telFacultatif;

        return $this;
    }

    public function getActivite(): ?string
    {
        return $this->activite;
    }

    public function setActivite(?string $activite): self
    {
        $this->activite = $activite;

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

    /**
     * @return Collection|Prospects[]
     */
    public function getProspects(): Collection
    {
        return $this->prospects;
    }

    public function addProspect(Prospects $prospect): self
    {
        if (!$this->prospects->contains($prospect)) {
            $this->prospects[] = $prospect;
            $prospect->setEntreprise($this);
        }

        return $this;
    }

    public function removeProspect(Prospects $prospect): self
    {
        if ($this->prospects->removeElement($prospect)) {
            // set the owning side to null (unless already changed)
            if ($prospect->getEntreprise() === $this) {
                $prospect->setEntreprise(null);
            }
        }

        return $this;
    }
    public function __toString(){
        return $this->denominationSociale;
    }

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
            $participant->setEntreprise($this);
        }

        return $this;
    }

    public function removeParticipant(Participants $participant): self
    {
        if ($this->participants->removeElement($participant)) {
            // set the owning side to null (unless already changed)
            if ($participant->getEntreprise() === $this) {
                $participant->setEntreprise(null);
            }
        }

        return $this;
    }

  
}
