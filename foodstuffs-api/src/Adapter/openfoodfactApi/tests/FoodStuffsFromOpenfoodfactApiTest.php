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
    public function it_can_search_foodstuffs_by_ean()
    {
        $ean = '3057640257773';

        $repository = new FoodStuffsFromOpenfoodfactApi(HttpClient::create());

        $this->assertEquals([new FoodStuff('3057640257773')], $repository->search('', [], $ean, '', ''));
    }

    /**
     * @test
     */
    public function it_can_search_foodstuffs_by_allergens()
    {
        $allergens = ['milk', 'gluten'];
        $repository = new FoodStuffsFromOpenfoodfactApi(HttpClient::create());

        $this->assertCount(24, $repository->search('', $allergens, '', '', ''));
    }
}
