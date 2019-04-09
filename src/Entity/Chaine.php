<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChaineRepository")
 */
class Chaine
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
    private $nomChaine;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ContenuDiffuse", mappedBy="Chaine", orphanRemoval=true)
     */
    private $contenuDiffuses;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Plateform", inversedBy="chaines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $plateform;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lienChaine;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageChaine;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estEnDirect;



    public $currentPlace;



    public function __construct()
    {
        $this->contenuDiffuses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomChaine(): ?string
    {
        return $this->nomChaine;
    }

    public function setNomChaine(string $nomChaine): self
    {
        $this->nomChaine = $nomChaine;

        return $this;
    }

    /**
     * @return Collection|ContenuDiffuse[]
     */
    public function getContenuDiffuses(): Collection
    {
        return $this->contenuDiffuses;
    }

    public function addContenuDiffus(ContenuDiffuse $contenuDiffus): self
    {
        if (!$this->contenuDiffuses->contains($contenuDiffus)) {
            $this->contenuDiffuses[] = $contenuDiffus;
            $contenuDiffus->setChaine($this);
        }

        return $this;
    }

    public function removeContenuDiffus(ContenuDiffuse $contenuDiffus): self
    {
        if ($this->contenuDiffuses->contains($contenuDiffus)) {
            $this->contenuDiffuses->removeElement($contenuDiffus);
            // set the owning side to null (unless already changed)
            if ($contenuDiffus->getChaine() === $this) {
                $contenuDiffus->setChaine(null);
            }
        }

        return $this;
    }

    public function getPlateform(): ?Plateform
    {
        return $this->plateform;
    }

    public function setPlateform(?Plateform $plateform): self
    {
        $this->plateform = $plateform;

        return $this;
    }

    public function getLienChaine(): ?string
    {
        return $this->lienChaine;
    }

    public function setLienChaine(string $lienChaine): self
    {
        $this->lienChaine = $lienChaine;

        return $this;
    }

    public function getImageChaine(): ?string
    {
        return $this->imageChaine;
    }

    public function setImageChaine(string $imageChaine): self
    {
        $this->imageChaine = $imageChaine;

        return $this;
    }

    public function getEstEnDirect(): ?bool
    {
        return $this->estEnDirect;
    }

    public function setEstEnDirect(bool $estEnDirect): self
    {
        $this->estEnDirect = $estEnDirect;

        return $this;
    }

    public function getUrlDataChaine()
    {
//        return $this->getPlateform()->getUrlData()
    }
}
