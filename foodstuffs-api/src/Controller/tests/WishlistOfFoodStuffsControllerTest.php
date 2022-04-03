<?php

namespace App\Controller\tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class WishlistOfFoodStuffsControllerTest extends WebTestCase
{
    /**
     * @var \Symfony\Bundle\FrameworkBundle\KernelBrowser
     */
    private $client;
    /**
     * @var \Doctrine\DBAL\Connection
     */
    private $connection;

    protected function setUp(): void
    {
        $this->client = static::createClient();

        parent::setUp();

        $this->connection = $this->getContainer()->get('Doctrine\DBAL\Connection');
        $this->connection->executeQuery('TRUNCATE TABLE wishlist_of_foodstuffs;');
    }

    /**
     * @test
     */
    public function it_can_add_a_foodstuff_to_his_wishlist()
    {
        $ean = '7850000000455';

        $this->client->request('GET', "/add/$ean");

        $wish = $this->connection->fetchFirstColumn("SELECT ean FROM wishlist_of_foodstuffs WHERE ean LIKE '$ean';");

        $this->assertNotFalse($wish, 'wish not found in db');
        $this->assertEquals('7850000000455', $wish[0]);
    }
}
