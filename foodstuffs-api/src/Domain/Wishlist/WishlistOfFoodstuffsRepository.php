<?php
declare(strict_types=1);

namespace App\Domain\Wishlist;

use App\Domain\foodstuffs\FoodStuff;

interface WishlistOfFoodstuffsRepository
{
    /**
     * @param string $ean
     *
     * @return mixed
     */
    function addWish(string $ean);

    /**
     * @param string $ean
     *
     * @return void
     */
    function removeWish(string $ean): void;
}
