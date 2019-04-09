<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VodRepository")
 */
class Vod
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
    private $nomVod;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomVod(): ?string
    {
        return $this->nomVod;
    }

    public function setNomVod(string $nomVod): self
    {
        $this->nomVod = $nomVod;

        return $this;
    }
}
