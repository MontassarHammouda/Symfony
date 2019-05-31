<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\MatiereRepository")
 */
class Matiere
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
     * @ORM\Column(type="text")
     */
    private $decription;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Prof", inversedBy="matieres")
     */

     
    private $profs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Chapitre", mappedBy="matiere", orphanRemoval=true)
     */
    private $chapitres;

    public function __construct()
    {
        $this->chapitres = new ArrayCollection();
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
    public function getDecription(): ?string
    {
        return $this->decription;
    }
    public function setDecription(string $decription): self
    {
        $this->decription = $decription;
        return $this;
    }
    public function getProfs(): ?Prof
    {
        return $this->profs;
    }
    public function setProfs(?Prof $profs): self
    {
        $this->profs = $profs;
        return $this;
    }

    /**
     * @return Collection|Chapitre[]
     */
    public function getChapitres(): Collection
    {
        return $this->chapitres;
    }

    public function addChapitre(Chapitre $chapitre): self
    {
        if (!$this->chapitres->contains($chapitre)) {
            $this->chapitres[] = $chapitre;
            $chapitre->setMatiere($this);
        }

        return $this;
    }

    public function removeChapitre(Chapitre $chapitre): self
    {
        if ($this->chapitres->contains($chapitre)) {
            $this->chapitres->removeElement($chapitre);
            // set the owning side to null (unless already changed)
            if ($chapitre->getMatiere() === $this) {
                $chapitre->setMatiere(null);
            }
        }

        return $this;
    }
}