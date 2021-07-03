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
     * @ORM\OneToMany(targetEntity=Apprenant::class, mappedBy="formation")
     */
    private $appForma;

    /**
     * @ORM\ManyToMany(targetEntity=Evaluation::class, inversedBy="formations")
     */
    private $evaForm;

    public function __construct()
    {
        $this->appForma = new ArrayCollection();
        $this->evaForm = new ArrayCollection();
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
            $appForma->setFormation($this);
        }

        return $this;
    }

    public function removeAppForma(Apprenant $appForma): self
    {
        if ($this->appForma->removeElement($appForma)) {
            // set the owning side to null (unless already changed)
            if ($appForma->getFormation() === $this) {
                $appForma->setFormation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Evaluation[]
     */
    public function getEvaForm(): Collection
    {
        return $this->evaForm;
    }

    public function addEvaForm(Evaluation $evaForm): self
    {
        if (!$this->evaForm->contains($evaForm)) {
            $this->evaForm[] = $evaForm;
        }

        return $this;
    }

    public function removeEvaForm(Evaluation $evaForm): self
    {
        $this->evaForm->removeElement($evaForm);

        return $this;
    }

    public function __toString()
    {
        return $this->getLibelle();
    }
}
