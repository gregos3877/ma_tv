<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
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
    private $nomCategory;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="categories")
     */
    private $sousCategory;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Category", mappedBy="sousCategory")
     */
    private $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCategory(): ?string
    {
        return $this->nomCategory;
    }

    public function setNomCategory(string $nomCategory): self
    {
        $this->nomCategory = $nomCategory;

        return $this;
    }

    public function getSousCategory(): ?self
    {
        return $this->sousCategory;
    }

    public function setSousCategory(?self $sousCategory): self
    {
        $this->sousCategory = $sousCategory;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(self $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setSousCategory($this);
        }

        return $this;
    }

    public function removeCategory(self $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
            // set the owning side to null (unless already changed)
            if ($category->getSousCategory() === $this) {
                $category->setSousCategory(null);
            }
        }

        return $this;
    }
}
