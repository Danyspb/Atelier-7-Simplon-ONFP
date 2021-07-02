<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
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
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=Evaluation::class, mappedBy="categorie")
     */
    private $evaCate;

    public function __construct()
    {
        $this->evaCate = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Evaluation[]
     */
    public function getEvaCate(): Collection
    {
        return $this->evaCate;
    }

    public function addEvaCate(Evaluation $evaCate): self
    {
        if (!$this->evaCate->contains($evaCate)) {
            $this->evaCate[] = $evaCate;
            $evaCate->setCategorie($this);
        }

        return $this;
    }

    public function removeEvaCate(Evaluation $evaCate): self
    {
        if ($this->evaCate->removeElement($evaCate)) {
            // set the owning side to null (unless already changed)
            if ($evaCate->getCategorie() === $this) {
                $evaCate->setCategorie(null);
            }
        }

        return $this;
    }
}
