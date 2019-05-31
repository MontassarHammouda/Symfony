<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExerciceRepository")
 */
class Exercice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $Urls;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Chapitre", inversedBy="exercices",cascade={"persist"}))
     * @ORM\JoinTable(name="compteRendu")
     * @ORM\JoinColumn(nullable=false)
     */
    private $chapitre;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CompteRendue", inversedBy="exercices")
     */
    private $compteRendu;

    public function __construct()
    {
        $this->compteRendu = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getUrls(): ?string
    {
        return $this->Urls;
    }

    public function setUrls(string $Urls): self
    {
        $this->Urls = $Urls;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getChapitre(): ?Chapitre
    {
        return $this->chapitre;
    }

    public function setChapitre(?Chapitre $chapitre): self
    {
        $this->chapitre = $chapitre;

        return $this;
    }

    /**
     * @return Collection|CompteRendue[]
     */
    public function getCompteRendu(): Collection
    {
        return $this->compteRendu;
    }

    public function addCompteRendu(CompteRendue $compteRendu): self
    {
        if (!$this->compteRendu->contains($compteRendu)) {
            $this->compteRendu[] = $compteRendu;
        }

        return $this;
    }

    public function removeCompteRendu(CompteRendue $compteRendu): self
    {
        if ($this->compteRendu->contains($compteRendu)) {
            $this->compteRendu->removeElement($compteRendu);
        }

        return $this;
    }
}
