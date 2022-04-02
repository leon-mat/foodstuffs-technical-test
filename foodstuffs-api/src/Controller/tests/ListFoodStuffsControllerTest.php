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

        $this->assertJson(
            '
            [
                {"ean":"7500000000125"},
                {"ean":"7500000000127"},
                {"ean":"7500000000282"}
            ]
            ',
            $content
        );
    }

    /**
     * @test
     */
    public function search_must_have_a_criteria_in_the_request()
    {
        $controller = new ListFoodStuffsController(new FoodStuffsFixturesRepository());

        $controller->search(new Request());

        $this->expectExceptionObject( new \InvalidArgumentException('missing a search criteria'));
    }
}
