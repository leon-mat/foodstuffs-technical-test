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
        $foodStuffs = [];

        $url = sprintf("https://fr.openfoodfacts.org/cgi/search.pl?code=%s&json=1", $ean);
        $response = $this->httpClient->request('GET', $url);

        $productsResponse = (\json_decode($response->getContent(), true))['products'];
        foreach ($productsResponse as $product) {
            $foodStuffs[] = $this->transformToFoodStuff($product);
        }

        return $foodStuffs;
    }

    private function transformToFoodStuff(array $product)
    {
        return new FoodStuff($product['code']);
    }
}
