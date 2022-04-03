<?php
declare(strict_types=1);

namespace App\Adapter\Wishlist;

use App\Domain\Wishlist\WishlistOfFoodstuffsRepository;
use Doctrine\DBAL\Connection;
use Psr\Log\LoggerInterface;

final class WishlistOfFoodstuffsMariaDbRepository implements WishlistOfFoodstuffsRepository
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

    function addWish(string $ean): void
    {
        $this->connection->executeQuery('INSERT INTO wishlist_of_foodstuffs (ean) VALUES (:ean);', ['ean' => $ean]);
        $this->logger->info('a foodstuff wish was added to mariadb', ['ean' => $ean]);
    }

    function removeWish(string $ean): void
    {
        $this->connection->executeQuery('DELETE FROM wishlist_of_foodstuffs WHERE ean LIKE :ean;', ['ean' => $ean]);
        $this->logger->info('a foodstuff wish was deleted to mariadb', ['ean' => $ean]);
    }

    public function clear(): void
    {
        $this->connection->executeQuery('DELETE FROM wishlist_of_foodstuffs');
        $this->logger->info('a wishlist was clear to mariadb');
    }
}
