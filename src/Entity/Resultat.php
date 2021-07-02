<?php

namespace App\Entity;

use App\Repository\ResultatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResultatRepository::class)
 */
class Resultat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity=Evaluation::class, inversedBy="resultats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $evaResul;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(float $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getEvaResul(): ?Evaluation
    {
        return $this->evaResul;
    }

    public function setEvaResul(?Evaluation $evaResul): self
    {
        $this->evaResul = $evaResul;

        return $this;
    }
}
