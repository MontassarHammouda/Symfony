<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtudiantRepository")
 */
class Etudiant
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $matricule;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CompteRendue", mappedBy="etudiant", orphanRemoval=true)
     */
    private $compteRendues;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageFilename;

    public function __construct()
    {
        $this->compteRendues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|CompteRendue[]
     */
    public function getCompteRendues(): Collection
    {
        return $this->compteRendues;
    }

    public function addCompteRendue(CompteRendue $compteRendue): self
    {
        if (!$this->compteRendues->contains($compteRendue)) {
            $this->compteRendues[] = $compteRendue;
            $compteRendue->setEtudiant($this);
        }

        return $this;
    }

    public function removeCompteRendue(CompteRendue $compteRendue): self
    {
        if ($this->compteRendues->contains($compteRendue)) {
            $this->compteRendues->removeElement($compteRendue);
            // set the owning side to null (unless already changed)
            if ($compteRendue->getEtudiant() === $this) {
                $compteRendue->setEtudiant(null);
            }
        }

        return $this;
    }

    public function getImageFilename(): ?string
    {
        return $this->imageFilename;
    }
    public function getImagePath()
    {
        return 'uploads/'.$this->getImageFilename();
    }

    public function setImageFilename(?string $imageFilename): self
    {
        $this->imageFilename = $imageFilename;

        return $this;
    }
}
