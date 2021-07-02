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
     * @ORM\ManyToMany(targetEntity=Formation::class, inversedBy="evaluations")
     */
    private $resultat;

    /**
     * @ORM\OneToMany(targetEntity=Resultat::class, mappedBy="evaResul")
     */
    private $resultats;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="evaCate")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    public function __construct()
    {
        $this->resultat = new ArrayCollection();
        $this->resultats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getResultat(): Collection
    {
        return $this->resultat;
    }

    public function addResultat(Formation $resultat): self
    {
        if (!$this->resultat->contains($resultat)) {
            $this->resultat[] = $resultat;
        }

        return $this;
    }

    public function removeResultat(Formation $resultat): self
    {
        $this->resultat->removeElement($resultat);

        return $this;
    }

    /**
     * @return Collection|Resultat[]
     */
    public function getResultats(): Collection
    {
        return $this->resultats;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}
