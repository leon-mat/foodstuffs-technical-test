<?php

namespace App\Controller\tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class WishlistOfFoodStuffsControllerTest extends WebTestCase
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    private $connection;

    protected function setUp(): void
    {
        parent::setUp();

        $this->connection = $this->getContainer()->get('doctrine.dbal.default_connection');
        $this->connection->executeQuery('TRUNCATE TABLE wishlist_of_foodstuffs;');
    }

    /**
     * @test
     */
    public function it_can_add_a_foodstuff_to_his_wishlist()
    {
        $ean = '7850000000455';
        $client = static::createClient();

        $client->request('GET', "/save/$ean");

        $wish = $this->connection->fetchAllAssociative('SELECT * FROM wishlist_of_foodstuffs WHERE ean = \'7850000000455\';');

        $this->assertEquals('7850000000455', $wish['ean']);
    }
}
