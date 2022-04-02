<?php

namespace App\Controller\tests;

use App\Controller\ListFoodStuffsController;
use App\Controller\tests\fixtures\FoodStuffsFixturesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ListFoodStuffsControllerTest extends WebTestCase
{
    /**
     * @test
     * functional test
     */
    public function search_can_return_json_with_foodstuffs()
    {
        $client = static::createClient();

        $client->request('GET', '/search/name?brand=danone');

        $content = $client->getResponse()->getContent();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJsonStringEqualsJsonString(
            '
            [
                {"allergens":"", "brand":"", "ean":"7500000000125", "ingredients": "tomate", "name":"Tomate", "nutriscore": "A"},
                {"allergens":"", "brand":"", "ean":"7500000000127", "ingredients": "patate", "name":"Patate", "nutriscore": "A"},
                {"allergens":"e25", "brand":"coca", "ean":"7500000000282", "ingredients": "sucre, eau, e25", "name":"Coca", "nutriscore": "E"}
            ]
            ',
            $content
        );
    }

    /**
     * @test
     */
    public function search_must_have_a_search_criteria_in_the_request()
    {
        $controller = new ListFoodStuffsController(new FoodStuffsFixturesRepository());

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('missing a search criteria');

        $controller->search(new Request());
    }
}
