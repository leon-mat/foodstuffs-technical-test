<?php

namespace App\Adapter\openfoodfactApi\tests;

use App\Adapter\openfoodfactApi\FoodStuffsFromOpenfoodfactApi;
use App\Domain\foodstuffs\FoodStuff;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttpClient;

final class FoodStuffsFromOpenfoodfactApiTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_search_a_foodstuff_by_ean()
    {
        $ean = '3057640257773';

        $repository = new FoodStuffsFromOpenfoodfactApi(HttpClient::create());
        $foodstuffs = $repository->search('', [], $ean, '', '');

        $this->assertCount(1 ,$foodstuffs);
        $this->assertEquals('3057640257773' , $foodstuffs[0]->getEan());
        $this->assertEquals('Volvic' , $foodstuffs[0]->getName());
    }

    /**
     * @test
     */
    public function it_can_search_foodstuffs_by_brand_allergens_and_category()
    {
        $brand = 'Danone';
        $allergens = ['milk', 'gluten'];
        $category = 'milk';

        $repository = new FoodStuffsFromOpenfoodfactApi(HttpClient::create());
        $foodstuffs = $repository->search('', $allergens, '', $brand, $category);

        $this->assertContainsOnlyInstancesOf(FoodStuff::class, $foodstuffs);
        $this->assertGreaterThan(2, $foodstuffs);
    }

    // @todo: add search a foodstuff by her name (not yet found in openfoodfact api)
}
