<?php

namespace App\Entity;

use App\Repository\EvaluationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvaluationRepository::class)
 */
class Evaluation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Formation::class, mappedBy="evaForm")
     */
    private $formations;

    /**
     * @ORM\OneToMany(targetEntity=Resultat::class, mappedBy="evaluation")
     */
    private $evaResul;

    /**
     * @ORM\OneToOne(targetEntity=Categorie::class, inversedBy="evaluation", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $catEva;

    public function __construct()
    {
        $this->formations = new ArrayCollection();
        $this->evaResul = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formations->contains($formation)) {
            $this->formations[] = $formation;
            $formation->addEvaForm($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formations->removeElement($formation)) {
            $formation->removeEvaForm($this);
        }

        return $this;
    }

    /**
     * @return Collection|Resultat[]
     */
    public function getEvaResul(): Collection
    {
        return $this->evaResul;
    }

    public function addEvaResul(Resultat $evaResul): self
    {
        if (!$this->evaResul->contains($evaResul)) {
            $this->evaResul[] = $evaResul;
            $evaResul->setEvaluation($this);
        }

        return $this;
    }

    public function removeEvaResul(Resultat $evaResul): self
    {
        if ($this->evaResul->removeElement($evaResul)) {
            // set the owning side to null (unless already changed)
            if ($evaResul->getEvaluation() === $this) {
                $evaResul->setEvaluation(null);
            }
        }

        return $this;
    }

    public function getCatEva(): ?Categorie
    {
        return $this->catEva;
    }

    public function setCatEva(Categorie $catEva): self
    {
        $this->catEva = $catEva;

        return $this;
    }
}
