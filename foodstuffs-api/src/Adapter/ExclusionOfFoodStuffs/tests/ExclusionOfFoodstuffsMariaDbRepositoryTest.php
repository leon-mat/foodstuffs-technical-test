<?php
declare(strict_types=1);

namespace App\Adapter\ExclusionOfFoodStuffs\tests;

use App\Adapter\ExclusionOfFoodStuffs\ExclusionOfFoodstuffsMariaDbRepository;
use Psr\Log\NullLogger;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ExclusionOfFoodstuffsMariaDbRepositoryTest extends WebTestCase
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    private $connection;

    protected function setUp(): void
    {
        parent::setUp();

        $this->connection = $this->getContainer()->get('Doctrine\DBAL\Connection');
        $this->connection->executeQuery('TRUNCATE TABLE excluded_foodstuffsx;');
    }

    /**
     * @test
     */
    public function it_exclude_a_foodstuff_in_database()
    {
        $ean = '9870000000766';
        $repository = new ExclusionOfFoodstuffsMariaDbRepository($this->connection, new NullLogger());

        $repository->exclude($ean);

        $wish = $this->connection->fetchFirstColumn("SELECT ean FROM excluded_foodstuffs WHERE ean LIKE '$ean';");

        $this->assertNotEmpty($wish, 'wish not found in db');
        $this->assertEquals('9870000000766', $wish[0]);
    }
}
