<?php
declare(strict_types=1);

namespace App\Adapter\Wishlist\tests;

use App\Adapter\Wishlist\WishlistOfFoodstuffsMariaDbRepository;
use Psr\Log\NullLogger;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class WishlistOfFoodstuffsMariaDbRepositoryTest extends WebTestCase
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    private $connection;

    protected function setUp(): void
    {
        parent::setUp();

        $this->connection = $this->getContainer()->get('Doctrine\DBAL\Connection');
        $this->connection->executeQuery('TRUNCATE TABLE wishlist_of_foodstuffs;');
    }

    /**
     * @test
     */
    public function it_insert_a_wish_to_database()
    {
        $ean = '9870000000723';
        $repository = new WishlistOfFoodstuffsMariaDbRepository($this->connection, new NullLogger());

        $repository->addWish($ean);

        $wishEan = $this->connection->fetchFirstColumn("SELECT ean FROM wishlist_of_foodstuffs WHERE ean LIKE '$ean';");

        $this->assertNotEmpty($wishEan, 'wish not found in db');
        $this->assertEquals('9870000000723', $wishEan[0]);
    }

    /**
     * @test
     */
    public function it_remove_a_existent_wish_to_database()
    {
        $ean = '9411000000466';
        $repository = new WishlistOfFoodstuffsMariaDbRepository($this->connection, new NullLogger());
        $this->connection->executeQuery("INSERT INTO wishlist_of_foodstuffs (ean) VALUES ('$ean');");

        $repository->removeWish($ean);

        $wishEan = $this->connection->fetchFirstColumn("SELECT ean FROM wishlist_of_foodstuffs WHERE ean LIKE '$ean';");

        $this->assertEmpty($wishEan);
    }
}
