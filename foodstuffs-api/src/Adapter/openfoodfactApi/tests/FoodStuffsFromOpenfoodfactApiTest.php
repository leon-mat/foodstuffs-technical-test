<?php

namespace App\Adapter\openfoodfactApi\tests;

use App\Adapter\openfoodfactApi\exceptions\FoodStuffNotFound;
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

    /**
     * @test
     */
    public function it_notify_a_not_found_foodstuff()
    {
        $notFoundEan = '9990009990001';

        $this->expectException(FoodStuffNotFound::class);

        $repository = new FoodStuffsFromOpenfoodfactApi(HttpClient::create());
        $foodstuff = $repository->getFoodStuffByEan($notFoundEan);
    }

    /**
     * @test
     */
    public function it_can_get_a_foodstuff_by_ean()
    {
        $ean = '7613035833272';

        $repository = new FoodStuffsFromOpenfoodfactApi(HttpClient::create());
        $foodstuff = $repository->getFoodStuffByEan($ean);

        $this->assertEquals($ean, $foodstuff->getEan());
    }

    // @todo: have a test to each criteria and a test by many criteria => by checking what the fields contain (!!!contain and not equal)

    // @todo: add search a foodstuff by her name (not yet founded in openfoodfact api)

    // @todo : test the comportment when openfoodfactapi return a error 500

    // @todo : pagination
}
