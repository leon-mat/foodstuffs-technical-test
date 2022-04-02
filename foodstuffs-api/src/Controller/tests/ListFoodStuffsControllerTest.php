<?php

namespace App\Controller\tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ListFoodStuffsControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function it_can_search_foodstuffs_by_criteria()
    {
        $client = static::createClient();

        $client->request('GET', '/search/name?brand=danone');

        $content = $client->getResponse()->getContent();

        $this->assertJson(
            '
            [{"ean":"7500000000125"},{"ean":"7500000000127"},{"ean":"7500000000282"}]
            ',
            $content
        );
    }
}
