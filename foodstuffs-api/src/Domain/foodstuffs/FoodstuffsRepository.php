<?php

namespace App\Domain\foodstuffs;

interface FoodstuffsRepository
{
    /**
     * @param string $name
     * @param array  $criteria
     * @param string $ean
     * @param string $brand
     * @param string $category
     *
     * @return FoodStuff[]
     */
    public function search(string $name, array $criteria, string $ean, string $brand, string $category): array;
}
