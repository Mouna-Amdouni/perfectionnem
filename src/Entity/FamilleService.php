<?php

namespace App\Entity;

use App\Repository\FamilleServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FamilleServiceRepository::class)
 */
class FamilleService
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
    private $nomFamille;

    /**
     * @ORM\OneToMany(targetEntity=Service::class, mappedBy="familleService")
     */
    private $service;

    public function __construct()
    {
        $this->service = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFamille(): ?string
    {
        return $this->nomFamille;
    }

    public function setNomFamille(?string $nomFamille): self
    {
        $this->nomFamille = $nomFamille;

        return $this;
    }

    /**
     * @return Collection|Service[]
     */
    public function getService(): Collection
    {
        return $this->service;
    }

    public function addService(Service $service): self
    {
        if (!$this->service->contains($service)) {
            $this->service[] = $service;
            $service->setFamilleService($this);
        }

        return $this;
    }

    public function removeService(Service $service): self
    {
        if ($this->service->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getFamilleService() === $this) {
                $service->setFamilleService(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->getNomFamille();
    }

}
