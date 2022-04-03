<?php
declare(strict_types=1);

namespace App\Controller\tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ExclusionOfFoodStuffsControllerTest extends WebTestCase
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
        $this->connection->executeQuery('TRUNCATE TABLE excluded_foodstuffs;');
    }

    /**
     * @test
     */
    public function it_can_exclude_a_foodstuff()
    {
        $ean = '7850000000455';

        $this->client->request('GET', "/exclude/$ean");

        $excludedEan = $this->connection->fetchFirstColumn("SELECT ean FROM excluded_foodstuffs WHERE ean LIKE '$ean';");

        $this->assertNotEmpty($excludedEan);
        $this->assertEquals('7850000000455', $excludedEan[0]);
    }
}
