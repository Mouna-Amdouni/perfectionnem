<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 */
class Service
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=5000, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datedeb;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datefin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $technologie;

    /**
     * @ORM\ManyToOne(targetEntity=FamilleService::class, inversedBy="service")
     */
    private $familleService;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDatedeb(): ?\DateTimeInterface
    {
        return $this->datedeb;
    }

    public function setDatedeb(?\DateTimeInterface $datedeb): self
    {
        $this->datedeb = $datedeb;

        return $this;
    }

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->datefin;
    }

    public function setDatefin(?\DateTimeInterface $datefin): self
    {
        $this->datefin = $datefin;

        return $this;
    }

    public function getTechnologie(): ?string
    {
        return $this->technologie;
    }

    public function setTechnologie(?string $technologie): self
    {
        $this->technologie = $technologie;

        return $this;
    }

    public function getFamilleService(): ?FamilleService
    {
        return $this->familleService;
    }

    public function setFamilleService(?FamilleService $familleService): self
    {
        $this->familleService = $familleService;

        return $this;
    }
}
