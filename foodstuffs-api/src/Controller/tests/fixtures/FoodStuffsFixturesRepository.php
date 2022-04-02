<?php

namespace App\Controller\tests\fixtures;

use App\Domain\foodstuffs\FoodStuff;
use App\Domain\foodstuffs\FoodStuffsRepository;

final class FoodStuffsFixturesRepository implements FoodStuffsRepository
{
    public function search(string $name, array $allergens, string $ean, string $brand, string $category): array
    {
        return [
            new FoodStuff('7500000000125', 'Tomate', '', 'tomate', '', 'A'),
            new FoodStuff('7500000000127', 'Patate', '', 'patate', '', 'A'),
            new FoodStuff('7500000000282', 'Coca', 'coca', 'sucre, eau, e25', 'e25', 'E')
        ];
    }
}
