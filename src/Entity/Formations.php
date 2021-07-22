<?php

namespace App\Entity;

use App\Repository\FormationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormationsRepository::class)
 */
class Formations
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
    private $titre;

    /**
     * @ORM\Column(type="float")
     */
    private $prixJour;

    /**
     * @ORM\Column(type="text")
     */
    private $programme;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $niveau;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $rubrique;

    /**
     * @ORM\ManyToMany(targetEntity=Formateurs::class, mappedBy="formations")
     */
    private $formateurs;

    /**
     * @ORM\ManyToMany(targetEntity=Devis::class, mappedBy="formations")
     */
    private $devis;

    /**
     * @ORM\ManyToMany(targetEntity=Prix::class, mappedBy="prixJourFormation")
     */
    private $prixes;

    /**
     * @ORM\ManyToMany(targetEntity=Template::class, mappedBy="formation")
     */
    private $templates;



    public function __construct()
    {
        $this->formateurs = new ArrayCollection();
        $this->devis = new ArrayCollection();
        $this->prixes = new ArrayCollection();
        $this->templates = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getPrixJour(): ?float
    {
        return $this->prixJour;
    }

    public function setPrixJour(float $prixJour): self
    {
        $this->prixJour = $prixJour;

        return $this;
    }

    public function getProgramme(): ?string
    {
        return $this->programme;
    }

    public function setProgramme(string $programme): self
    {
        $this->programme = $programme;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getRubrique(): ?string
    {
        return $this->rubrique;
    }

    public function setRubrique(string $rubrique): self
    {
        $this->rubrique = $rubrique;

        return $this;
    }

    /**
     * @return Collection|Formateurs[]
     */
    public function getFormateurs(): Collection
    {
        return $this->formateurs;
    }

    public function addFormateur(Formateurs $formateur): self
    {
        if (!$this->formateurs->contains($formateur)) {
            $this->formateurs[] = $formateur;
            $formateur->addFormation($this);
        }

        return $this;
    }

    public function removeFormateur(Formateurs $formateur): self
    {
        if ($this->formateurs->removeElement($formateur)) {
            $formateur->removeFormation($this);
        }

        return $this;
    }
    public function __toString(){
        return $this->titre;
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
            $devi->addFormation($this);
        }

        return $this;
    }

    public function removeDevi(Devis $devi): self
    {
        if ($this->devis->removeElement($devi)) {
            $devi->removeFormation($this);
        }

        return $this;
    }

    /**
     * @return Collection|Prix[]
     */
    public function getPrixes(): Collection
    {
        return $this->prixes;
    }

    public function addPrix(Prix $prix): self
    {
        if (!$this->prixes->contains($prix)) {
            $this->prixes[] = $prix;
            $prix->addPrixJourFormation($this);
        }

        return $this;
    }

    public function removePrix(Prix $prix): self
    {
        if ($this->prixes->removeElement($prix)) {
            $prix->removePrixJourFormation($this);
        }

        return $this;
    }

    /**
     * @return Collection|Template[]
     */
    public function getTemplates(): Collection
    {
        return $this->templates;
    }

    public function addTemplate(Template $template): self
    {
        if (!$this->templates->contains($template)) {
            $this->templates[] = $template;
            $template->addFormation($this);
        }

        return $this;
    }

    public function removeTemplate(Template $template): self
    {
        if ($this->templates->removeElement($template)) {
            $template->removeFormation($this);
        }

        return $this;
    }


}
