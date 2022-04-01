<?php

namespace App\Domain\foodstuffs;

interface FoodstuffsRepository
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
}
