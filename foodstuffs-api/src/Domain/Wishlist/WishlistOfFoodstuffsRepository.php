<?php
declare(strict_types=1);

namespace App\Domain\Wishlist;

use App\Domain\foodstuffs\FoodStuff;

interface WishlistOfFoodstuffsRepository
{
    function addWish(string $ean);
}
