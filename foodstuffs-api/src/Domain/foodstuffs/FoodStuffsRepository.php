<?php

namespace App\Domain\foodstuffs;

interface FoodStuffsRepository
{
    /**
     * @param string   $name
     * @param string[] $allergens
     * @param string   $ean
     * @param string   $brand
     * @param string   $category
     *
     * @return FoodStuff[]
     */
    public function search(string $name, array $allergens, string $ean, string $brand, string $category): array;

    /**
     * @param string $ean
     *
     * @return FoodStuff
     */
    public function getFoodStuffByEan(string $ean): FoodStuff;
}
