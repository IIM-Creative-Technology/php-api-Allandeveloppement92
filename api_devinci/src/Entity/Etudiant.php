<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtudiantRepository::class)
 */
class Etudiant
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
    private $nomEtudiant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomEtudiant;

    /**
     * @ORM\Column(type="integer")
     */
    private $ageEtudiant;

    /**
     * @ORM\Column(type="integer")
     */
    private $arriveeEtudiant;

    /**
     * @ORM\ManyToOne(targetEntity=Promotion::class, inversedBy="etudiants")
     */
    private $promotionEtudiant;

    /**
     * @ORM\OneToMany(targetEntity=Note::class, mappedBy="etudiant")
     */
    private $notes;


    public function __construct()
    {
        $this->notes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEtudiant(): ?string
    {
        return $this->nomEtudiant;
    }

    public function setNomEtudiant(string $nomEtudiant): self
    {
        $this->nomEtudiant = $nomEtudiant;

        return $this;
    }

    public function getPrenomEtudiant(): ?string
    {
        return $this->prenomEtudiant;
    }

    public function setPrenomEtudiant(string $prenomEtudiant): self
    {
        $this->prenomEtudiant = $prenomEtudiant;

        return $this;
    }

    public function getAgeEtudiant(): ?int
    {
        return $this->ageEtudiant;
    }

    public function setAgeEtudiant(int $ageEtudiant): self
    {
        $this->ageEtudiant = $ageEtudiant;

        return $this;
    }

    public function getArriveeEtudiant(): ?int
    {
        return $this->arriveeEtudiant;
    }

    public function setArriveeEtudiant(int $arriveeEtudiant): self
    {
        $this->arriveeEtudiant = $arriveeEtudiant;

        return $this;
    }

    public function getPromotionEtudiant(): ?Promotion
    {
        return $this->promotionEtudiant;
    }

    public function setPromotionEtudiant(?Promotion $promotionEtudiant): self
    {
        $this->promotionEtudiant = $promotionEtudiant;

        return $this;
    }

    /**
     * @return Collection|Note[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setEtudiant($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getEtudiant() === $this) {
                $note->setEtudiant(null);
            }
        }

        return $this;
    }
}
