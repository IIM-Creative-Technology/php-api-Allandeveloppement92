<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=MatiereRepository::class)
 */
class Matiere
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
    private $nomCours;

    /**
     * @ORM\Column(type="datetime")
     */
    private $debutCours;

    /**
     * @ORM\Column(type="datetime")
     */
    private $finCours;

    /**
     * @ORM\OneToMany(targetEntity=Intervenant::class, mappedBy="matiere")
     */
    private $intervenant;

    /**
     * @ORM\OneToOne(targetEntity=Promotion::class, cascade={"persist", "remove"})
     */
    private $promotion;

    /**
     * @ORM\OneToMany(targetEntity=Note::class, mappedBy="matiere")
     */
    private $notes;

    public function __construct()
    {
        $this->intervenant = new ArrayCollection();
        $this->notes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCours(): ?string
    {
        return $this->nomCours;
    }

    public function setNomCours(string $nomCours): self
    {
        $this->nomCours = $nomCours;

        return $this;
    }

    public function getDebutCours(): ?\DateTimeInterface
    {
        return $this->debutCours;
    }

    public function setDebutCours(\DateTimeInterface $debutCours): self
    {
        $this->debutCours = $debutCours;

        return $this;
    }

    public function getFinCours(): ?\DateTimeInterface
    {
        return $this->finCours;
    }

    public function setFinCours(\DateTimeInterface $finCours): self
    {
        $this->finCours = $finCours;

        return $this;
    }

    /**
     * @return Collection|Intervenant[]
     */
    public function getIntervenant(): Collection
    {
        return $this->intervenant;
    }

    public function addIntervenant(Intervenant $intervenant): self
    {
        if (!$this->intervenant->contains($intervenant)) {
            $this->intervenant[] = $intervenant;
            $intervenant->setMatiere($this);
        }

        return $this;
    }

    public function removeIntervenant(Intervenant $intervenant): self
    {
        if ($this->intervenant->removeElement($intervenant)) {
            // set the owning side to null (unless already changed)
            if ($intervenant->getMatiere() === $this) {
                $intervenant->setMatiere(null);
            }
        }

        return $this;
    }

    public function getPromotion(): ?Promotion
    {
        return $this->promotion;
    }

    public function setPromotion(?Promotion $promotion): self
    {
        $this->promotion = $promotion;

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
            $note->setMatiere($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getMatiere() === $this) {
                $note->setMatiere(null);
            }
        }

        return $this;
    }
}
