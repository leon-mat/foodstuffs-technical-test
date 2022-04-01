<?php

namespace App\Adapter\openfoodfactApi;

use App\Domain\foodstuffs\FoodStuff;
use App\Domain\foodstuffs\FoodstuffsRepository;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class FoodStuffsFromOpenfoodfactApi implements FoodstuffsRepository
{
    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function search(string $name, array $criteria, string $ean, string $brand, string $category): array
    {
        return [];
    }
}
