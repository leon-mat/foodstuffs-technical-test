<?php
declare(strict_types=1);

namespace App\Adapter\ExclusionOfFoodStuffs;

use App\Domain\ExclusionOfFoodStuffs\ExclusionOfFoodstuffsRepository;
use Doctrine\DBAL\Connection;
use Psr\Log\LoggerInterface;

final class ExclusionOfFoodstuffsMariaDbRepository implements ExclusionOfFoodstuffsRepository
{
    /**
     * @var Connection
     */
    private $connection;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(Connection $connection, LoggerInterface $logger)
    {
        $this->connection = $connection;
        $this->logger = $logger;
    }

    function exclude(string $ean): void
    {
        $this->connection->executeQuery('INSERT INTO excluded_foodstuffs (ean) VALUES (:ean);', ['ean' => $ean]);
        $this->logger->info('a foodstuff was excluded in mariadb', ['ean' => $ean]);
    }
}
