<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormationRepository::class)
 */
class Formation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=Apprenant::class, inversedBy="formations")
     */
    private $appForma;

    /**
     * @ORM\ManyToMany(targetEntity=Evaluation::class, mappedBy="resultat")
     */
    private $evaluations;

    public function __construct()
    {
        $this->appForma = new ArrayCollection();
        $this->evaluations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Apprenant[]
     */
    public function getAppForma(): Collection
    {
        return $this->appForma;
    }

    public function addAppForma(Apprenant $appForma): self
    {
        if (!$this->appForma->contains($appForma)) {
            $this->appForma[] = $appForma;
        }

        return $this;
    }

    public function removeAppForma(Apprenant $appForma): self
    {
        $this->appForma->removeElement($appForma);

        return $this;
    }

    /**
     * @return Collection|Evaluation[]
     */
    public function getEvaluations(): Collection
    {
        return $this->evaluations;
    }

    public function addEvaluation(Evaluation $evaluation): self
    {
        if (!$this->evaluations->contains($evaluation)) {
            $this->evaluations[] = $evaluation;
            $evaluation->addResultat($this);
        }

        return $this;
    }

    public function removeEvaluation(Evaluation $evaluation): self
    {
        if ($this->evaluations->removeElement($evaluation)) {
            $evaluation->removeResultat($this);
        }

        return $this;
    }
}
