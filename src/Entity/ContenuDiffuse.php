<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContenuDiffuseRepository")
 */
class ContenuDiffuse
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tv", inversedBy="contenuDiffuses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Tv;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Chaine", inversedBy="contenuDiffuses", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Chaine;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTv(): ?Tv
    {
        return $this->Tv;
    }

    public function setTv(?Tv $Tv): self
    {
        $this->Tv = $Tv;

        return $this;
    }

    public function getChaine(): ?Chaine
    {
        return $this->Chaine;
    }

    public function setChaine(?Chaine $Chaine): self
    {
        $this->Chaine = $Chaine;

        return $this;
    }
}
