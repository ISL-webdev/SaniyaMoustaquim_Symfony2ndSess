<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 */
class Ingredient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Cocktail::class, inversedBy="cocktail_ingredients")
     */
    private $cocktails_ingredients;

    public function __construct()
    {
        $this->cocktails_ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Cocktail[]
     */
    public function getCocktailsIngredients(): Collection
    {
        return $this->cocktails_ingredients;
    }

    public function addCocktailsIngredient(Cocktail $cocktailsIngredient): self
    {
        if (!$this->cocktails_ingredients->contains($cocktailsIngredient)) {
            $this->cocktails_ingredients[] = $cocktailsIngredient;
        }

        return $this;
    }

    public function removeCocktailsIngredient(Cocktail $cocktailsIngredient): self
    {
        if ($this->cocktails_ingredients->contains($cocktailsIngredient)) {
            $this->cocktails_ingredients->removeElement($cocktailsIngredient);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getDescription();
    }
}
