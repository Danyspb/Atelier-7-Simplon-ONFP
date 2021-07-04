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
     * @ORM\OneToOne(targetEntity=Categorie::class, inversedBy="evaluation", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $catEva;

    /**
     * @ORM\Column(type="date")
     */
    private $date_evaluation;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $note1;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $note2;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $note3;

    public function __construct()
    {
        $this->formations = new ArrayCollection();
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

    public function getCatEva(): ?Categorie
    {
        return $this->catEva;
    }

    public function setCatEva(Categorie $catEva): self
    {
        $this->catEva = $catEva;

        return $this;
    }

    public function getDateEvaluation(): ?\DateTimeInterface
    {
        return $this->date_evaluation;
    }

    public function setDateEvaluation(\DateTimeInterface $date_evaluation): self
    {
        $this->date_evaluation = $date_evaluation;

        return $this;
    }

    public function getNote1(): ?float
    {
        return $this->note1;
    }

    public function setNote1(?float $note1): self
    {
        $this->note1 = $note1;

        return $this;
    }

    public function getNote2(): ?float
    {
        return $this->note2;
    }

    public function setNote2(?float $note2): self
    {
        $this->note2 = $note2;

        return $this;
    }

    public function getNote3(): ?float
    {
        return $this->note3;
    }

    public function setNote3(?float $note3): self
    {
        $this->note3 = $note3;

        return $this;
    }
}
