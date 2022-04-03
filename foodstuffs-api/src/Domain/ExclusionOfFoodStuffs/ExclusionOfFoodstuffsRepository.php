<?php
declare(strict_types=1);

namespace App\Domain\ExclusionOfFoodStuffs;

interface ExclusionOfFoodstuffsRepository
{
    /**
     * @param string $ean
     *
     * @return void
     */
    function exclude(string $ean): void;
}
