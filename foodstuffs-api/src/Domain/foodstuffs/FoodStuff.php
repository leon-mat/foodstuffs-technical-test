<?php

namespace App\Domain\foodstuffs;

final class FoodStuff
{
    /**
     * @var string
     */
    private $ean;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $brand;
    /**
     * @var string
     */
    private $ingredients;
    /**
     * @var string
     */
    private $allergens;
    /**
     * @var string
     */
    private $nutriscore;

    public function __construct(string $ean, string $name, string $brand, string $ingredients, string $allergens, string $nutriscore)
    {
        if (empty($ean)) {
            throw new InvalidFoodstuffEANException();
        }

        $this->ean = $ean;
        $this->name = $name;
        $this->brand = $brand;
        $this->ingredients = $ingredients;
        $this->allergens = $allergens;
        $this->nutriscore = $nutriscore;
    }

    public function getEan(): string
    {
        return $this->ean;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @return string
     */
    public function getIngredients(): string
    {
        return $this->ingredients;
    }

    /**
     * @return string
     */
    public function getAllergens(): string
    {
        return $this->allergens;
    }

    /**
     * @return string
     */
    public function getNutriscore(): string
    {
        return $this->nutriscore;
    }

}
