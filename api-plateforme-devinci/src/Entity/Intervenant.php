<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\IntervenantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=IntervenantRepository::class)
 */
class Intervenant
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
    private $prenomIntervenant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomIntervenant;

    /**
     * @ORM\Column(type="integer")
     */
    private $dateArriveeIntervenant;

    /**
     * @ORM\ManyToOne(targetEntity=Matiere::class, inversedBy="intervenant")
     */
    private $matiere;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenomIntervenant(): ?string
    {
        return $this->prenomIntervenant;
    }

    public function setPrenomIntervenant(string $prenomIntervenant): self
    {
        $this->prenomIntervenant = $prenomIntervenant;

        return $this;
    }

    public function getNomIntervenant(): ?string
    {
        return $this->nomIntervenant;
    }

    public function setNomIntervenant(string $nomIntervenant): self
    {
        $this->nomIntervenant = $nomIntervenant;

        return $this;
    }

    public function getDateArriveeIntervenant(): ?int
    {
        return $this->dateArriveeIntervenant;
    }

    public function setDateArriveeIntervenant(int $dateArriveeIntervenant): self
    {
        $this->dateArriveeIntervenant = $dateArriveeIntervenant;

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }
}
