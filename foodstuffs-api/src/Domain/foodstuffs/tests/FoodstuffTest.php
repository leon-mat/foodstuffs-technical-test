<?php

namespace App\Domain\foodstuffs\tests;

use App\Domain\foodstuffs\FoodStuff;
use App\Domain\foodstuffs\InvalidFoodstuffEANException;
use PHPUnit\Framework\TestCase;

final class FoodstuffTest extends TestCase
{
    /**
     * @test
     */
    public function a_foodstuff_can_have_a_ean_id()
    {
        $this->expectException(InvalidFoodstuffEANException::class);

        new FoodStuff('');
    }
}
