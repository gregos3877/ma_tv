<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LiveRepository")
 */
class Live
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
    private $nomLive;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomLive(): ?string
    {
        return $this->nomLive;
    }

    public function setNomLive(string $nomLive): self
    {
        $this->nomLive = $nomLive;

        return $this;
    }
}
