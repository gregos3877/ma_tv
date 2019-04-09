<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlateformRepository")
 */
class Plateform
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
    private $nomPlateform;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lienPlateform;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Chaine", mappedBy="plateform")
     */
    private $chaines;

    public function __construct()
    {
        $this->chaines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPlateform(): ?string
    {
        return $this->nomPlateform;
    }

    public function setNomPlateform(string $nomPlateform): self
    {
        $this->nomPlateform = $nomPlateform;

        return $this;
    }

    public function getLienPlateform(): ?string
    {
        return $this->lienPlateform;
    }

    public function setLienPlateform(string $lienPlateform): self
    {
        $this->lienPlateform = $lienPlateform;

        return $this;
    }

    /**
     * @return Collection|Chaine[]
     */
    public function getChaines(): Collection
    {
        return $this->chaines;
    }

    public function addChaine(Chaine $chaine): self
    {
        if (!$this->chaines->contains($chaine)) {
            $this->chaines[] = $chaine;
            $chaine->setPlateform($this);
        }

        return $this;
    }

    public function removeChaine(Chaine $chaine): self
    {
        if ($this->chaines->contains($chaine)) {
            $this->chaines->removeElement($chaine);
            // set the owning side to null (unless already changed)
            if ($chaine->getPlateform() === $this) {
                $chaine->setPlateform(null);
            }
        }

        return $this;
    }

    public function getUrlDataChaine()
    {

    }
}
