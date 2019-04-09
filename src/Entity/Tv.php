<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TvRepository")
 */
class Tv
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
    private $nomTv;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationTv;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ContenuDiffuse", mappedBy="Tv")
     */
    private $contenuDiffuses;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="tv", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    private $chaines;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionTv;

    public function __construct($nomTv, $user)
    {
        $this->creationTv = new \DateTime('NOW');
        $this->contenuDiffuses = new ArrayCollection();
        $this->nomTv = $nomTv;
        $this->user = $user;
    }

    public function getChaines()
    {
        $liste = [];

        foreach ($this->getContenuDiffuses() as $c )
        {
            $liste[] = $c->getChaine();
        }

        return $liste;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTv(): ?string
    {
        return $this->nomTv;
    }

    public function setNomTv(string $nomTv): self
    {
        $this->nomTv = $nomTv;

        return $this;
    }

    public function getCreationTv(): ?\DateTimeInterface
    {
        return $this->creationTv;
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
            $contenuDiffus->setTv($this);
        }

        return $this;
    }

    public function removeContenuDiffus(ContenuDiffuse $contenuDiffus): self
    {
        if ($this->contenuDiffuses->contains($contenuDiffus)) {
            $this->contenuDiffuses->removeElement($contenuDiffus);
            // set the owning side to null (unless already changed)
            if ($contenuDiffus->getTv() === $this) {
                $contenuDiffus->setTv(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDescriptionTv(): ?string
    {
        return $this->descriptionTv;
    }

    public function setDescriptionTv(?string $descriptionTv): self
    {
        $this->descriptionTv = $descriptionTv;

        return $this;
    }


}
