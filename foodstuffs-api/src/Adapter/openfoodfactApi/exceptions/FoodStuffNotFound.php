<?php
declare(strict_types=1);

namespace App\Adapter\openfoodfactApi\exceptions;

final class FoodStuffNotFound extends \Exception
{
    public function __construct()
    {
        parent::__construct('no foodstuff was found');
    }
}
