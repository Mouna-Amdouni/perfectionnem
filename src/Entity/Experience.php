<?php

namespace App\Entity;

use App\Repository\ExperienceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExperienceRepository::class)
 */
class Experience
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateFrom;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateTo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Location;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $societe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lienSociete;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $position;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lienDescription;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="experiences")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateFrom(): ?\DateTimeInterface
    {
        return $this->DateFrom;
    }

    public function setDateFrom(?\DateTimeInterface $DateFrom): self
    {
        $this->DateFrom = $DateFrom;

        return $this;
    }

    public function getDateTo(): ?\DateTimeInterface
    {
        return $this->DateTo;
    }

    public function setDateTo(?\DateTimeInterface $DateTo): self
    {
        $this->DateTo = $DateTo;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->Location;
    }

    public function setLocation(?string $Location): self
    {
        $this->Location = $Location;

        return $this;
    }

    public function getSociete(): ?string
    {
        return $this->societe;
    }

    public function setSociete(?string $societe): self
    {
        $this->societe = $societe;

        return $this;
    }

    public function getLienSociete(): ?string
    {
        return $this->lienSociete;
    }

    public function setLienSociete(?string $lienSociete): self
    {
        $this->lienSociete = $lienSociete;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): self
    {
        $this->position = $position;

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

    public function getLienDescription(): ?string
    {
        return $this->lienDescription;
    }

    public function setLienDescription(?string $lienDescription): self
    {
        $this->lienDescription = $lienDescription;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
