<?php

namespace App\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class WishlistOfFoodStuffsController extends AbstractController
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function add(string $ean)
    {
        $this->connection->executeQuery('INSERT INTO wishlist_of_foodstuffs (ean) VALUES (:ean);', ['ean' => $ean]);

        return new Response('', 200);
    }
}
