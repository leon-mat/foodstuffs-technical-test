<?php
declare(strict_types=1);

namespace App\Controller\tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

        $this->assertNotEmpty($wish);
        $this->assertEquals('7850000000455', $wish[0]);
    }

    /**
     * @test
     */
    public function it_can_delete_a_foodstuff_to_his_wishlist()
    {
        $ean = '7850000000455';
        $this->connection->executeQuery("INSERT INTO wishlist_of_foodstuffs (ean) VALUES ('$ean');");

        $this->client->request('GET', "/delete/$ean");

        $wish = $this->connection->fetchFirstColumn("SELECT ean FROM wishlist_of_foodstuffs WHERE ean LIKE '$ean';");

        $this->assertEmpty($wish);
    }

    /**
     * @test
     * (it_can_clear_the_wishlist_of_a_user after add jwt)
     */
    public function it_can_clear_the_wishlist()
    {
        $this->connection->executeQuery("INSERT INTO wishlist_of_foodstuffs (ean) VALUES ('".rand(100,10000)."');");
        $this->connection->executeQuery("INSERT INTO wishlist_of_foodstuffs (ean) VALUES ('".rand(100,10000)."');");
        $this->connection->executeQuery("INSERT INTO wishlist_of_foodstuffs (ean) VALUES ('".rand(100,10000)."');");

        $this->client->request('GET', "/clear");

        $wishEan = $this->connection->fetchAllAssociative("SELECT * FROM wishlist_of_foodstuffs;");

        $this->assertEmpty($wishEan);
    }

    //@todo: refacto FoodStuffsFixturesRepository to up this test
    /**
     * @test
     *
    public function it_notify_a_not_found_foodstuff_to_add_it_in_wishlist()
    {
        $badEan = '9990009990005';

        $this->expectException(NotFoundHttpException::class);

        $this->client->request('GET', "/add/$badEan");
    }*/
}
