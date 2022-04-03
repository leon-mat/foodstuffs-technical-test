<?php
declare(strict_types=1);

namespace App\Controller;

use App\Domain\Wishlist\WishlistOfFoodstuffsRepository;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class WishlistOfFoodStuffsController extends AbstractController
{
    /**
     * @var WishlistOfFoodstuffsRepository
     */
    private $wishlistOfFoodstuffsRepository;

    public function __construct(WishlistOfFoodstuffsRepository $wishlistOfFoodstuffsRepository)
    {
        $this->wishlistOfFoodstuffsRepository = $wishlistOfFoodstuffsRepository;
    }

    public function add(string $ean)
    {
        $this->wishlistOfFoodstuffsRepository->addWish($ean);

        return new Response('', 200);
    }
}
