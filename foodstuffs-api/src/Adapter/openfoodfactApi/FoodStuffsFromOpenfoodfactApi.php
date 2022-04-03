<?php

namespace App\Adapter\openfoodfactApi;

use App\Adapter\openfoodfactApi\exceptions\FoodStuffNotFound;
use App\Domain\foodstuffs\FoodStuff;
use App\Domain\foodstuffs\FoodStuffsRepository;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class FoodStuffsFromOpenfoodfactApi implements FoodStuffsRepository
{
    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function search(string $name, array $allergens, string $ean, string $brand, string $category): array
    {
        $foodStuffs = [];

        $url = OpenfoodfactUrlFactory::generateUrl($ean, $allergens, $brand, $category);
        $response = $this->httpClient->request('GET', $url);

        $productsResponse = (\json_decode($response->getContent(), true))['products'];
        foreach ($productsResponse as $product) {
            $foodStuffs[] = $this->transformToFoodStuff($product);
        }

        return $foodStuffs;
    }

    public function getFoodStuffByEan(string $ean): FoodStuff
    {
        $url = OpenfoodfactUrlFactory::generateUrl($ean, [], '', '');
        $response = $this->httpClient->request('GET', $url);

        $productResponse = (\json_decode($response->getContent(), true))['products'];
        if (empty($productResponse)) {
            throw new FoodStuffNotFound();
        }

        return $this->transformToFoodStuff($productResponse[0]);
    }

    private function transformToFoodStuff(array $product)
    {
        return new FoodStuff(
            $product['code'],
            $product['product_name_fr'],
            $product['brands'],
            $product['ingredients_text_fr'],
            $product['allergens_from_ingredients'],
            $product['nutriscore_grade']
        );
    }
}
