<?php

namespace App\Entity;

use App\Repository\ProspectsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProspectsRepository::class)
 */
class Prospects
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
    private $statut;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $site;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="prospects", cascade={"persist"})
     */
    private $entreprise;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="boolean")
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity=Devis::class, mappedBy="client")
     */
    private $devis;

    /**
     * @ORM\OneToMany(targetEntity=Conventions::class, mappedBy="prospect")
     */
    private $conventions;

    /**
     * @ORM\ManyToMany(targetEntity=Devis::class, mappedBy="nomContact")
     */
    private $devisNom;

    public function __construct()
    {
        $this->devis = new ArrayCollection();
        $this->conventions = new ArrayCollection();
        $this->devisNom = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(?string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function setSite(?string $site): self
    {
        $this->site = $site;

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

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    
    public function __toString(){
        return $this->nom;
    }

    public function getRole(): ?bool
    {
        return $this->role;
    }

    public function setRole(bool $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection|Devis[]
     */
    public function getDevis(): Collection
    {
        return $this->devis;
    }

    public function addDevi(Devis $devi): self
    {
        if (!$this->devis->contains($devi)) {
            $this->devis[] = $devi;
            $devi->setClient($this);
        }

        return $this;
    }

    public function removeDevi(Devis $devi): self
    {
        if ($this->devis->removeElement($devi)) {
            // set the owning side to null (unless already changed)
            if ($devi->getClient() === $this) {
                $devi->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Conventions[]
     */
    public function getConventions(): Collection
    {
        return $this->conventions;
    }

    public function addConvention(Conventions $convention): self
    {
        if (!$this->conventions->contains($convention)) {
            $this->conventions[] = $convention;
            $convention->setProspect($this);
        }

        return $this;
    }

    public function removeConvention(Conventions $convention): self
    {
        if ($this->conventions->removeElement($convention)) {
            // set the owning side to null (unless already changed)
            if ($convention->getProspect() === $this) {
                $convention->setProspect(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Devis[]
     */
    public function getDevisNom(): Collection
    {
        return $this->devisNom;
    }

    public function addDevisNom(Devis $devisNom): self
    {
        if (!$this->devisNom->contains($devisNom)) {
            $this->devisNom[] = $devisNom;
            $devisNom->setNomContact($this);
        }

        return $this;
    }

    // public function removeDevisNom(Devis $devisNom): self
    // {
    //     if ($this->devisNom->removeElement($devisNom)) {
    //         $devisNom->removeNomContact($this);
    //     }

    //     return $this;
    // }
}
