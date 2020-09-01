<?php

namespace App\Entity;

use App\Repository\CocktailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CocktailRepository::class)
 */
class Cocktail
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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $volume;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $origin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity=Ingredient::class, mappedBy="cocktails_ingredients")
     */
    private $cocktail_ingredients;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="cocktails")
     */
    private $category;

    public function __construct()
    {
        $this->cocktail_ingredients = new ArrayCollection();
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(int $volume): self
    {
        $this->volume = $volume;

        return $this;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(string $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getCocktailIngredients(): Collection
    {
        return $this->cocktail_ingredients;
    }

    public function addCocktailIngredient(Ingredient $cocktailIngredient): self
    {
        if (!$this->cocktail_ingredients->contains($cocktailIngredient)) {
            $this->cocktail_ingredients[] = $cocktailIngredient;
            $cocktailIngredient->addCocktailsIngredient($this);
        }

        return $this;
    }

    public function removeCocktailIngredient(Ingredient $cocktailIngredient): self
    {
        if ($this->cocktail_ingredients->contains($cocktailIngredient)) {
            $this->cocktail_ingredients->removeElement($cocktailIngredient);
            $cocktailIngredient->removeCocktailsIngredient($this);
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
