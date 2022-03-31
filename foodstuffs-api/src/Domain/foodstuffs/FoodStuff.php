<?php

namespace App\Domain\foodstuffs;

final class FoodStuff
{
    /**
     * @var string
     */
    private $ean;

    public function __construct(string $ean)
    {
        if (empty($ean)) {
            throw new InvalidFoodstuffEANException();
        }

        $this->ean = $ean;
    }

    public function getEan(): string
    {
        return $this->ean;
    }
}
