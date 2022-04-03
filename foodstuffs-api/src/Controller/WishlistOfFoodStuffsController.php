<?php
declare(strict_types=1);

namespace App\Controller;

use App\Adapter\openfoodfactApi\exceptions\FoodStuffNotFound;
use App\Domain\foodstuffs\FoodStuffsRepository;
use App\Domain\Wishlist\WishlistOfFoodstuffsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class WishlistOfFoodStuffsController extends AbstractController
{
    /**
     * @var WishlistOfFoodstuffsRepository
     */
    private $wishlistOfFoodstuffsRepository;
    /**
     * @var FoodStuffsRepository
     */
    private $foodStuffsRepository;

    public function __construct(WishlistOfFoodstuffsRepository $wishlistOfFoodstuffsRepository, FoodStuffsRepository $foodStuffsRepository)
    {
        $this->wishlistOfFoodstuffsRepository = $wishlistOfFoodstuffsRepository;
        $this->foodStuffsRepository = $foodStuffsRepository;
    }

    public function add(string $ean)
    {
        try {
            $foodStuff = $this->foodStuffsRepository->getFoodStuffByEan($ean);
        } catch (FoodStuffNotFound $e) {
            throw new NotFoundHttpException('foodstuff not found', $e);
        }
        $this->wishlistOfFoodstuffsRepository->addWish($foodStuff->getEan());

        return new Response('', 200);
    }

    public function delete(string $ean)
    {
        try {
            $foodStuff = $this->foodStuffsRepository->getFoodStuffByEan($ean);
        } catch (FoodStuffNotFound $e) {
            throw new NotFoundHttpException('foodstuff not found', $e);
        }
        $this->wishlistOfFoodstuffsRepository->removeWish($foodStuff->getEan());

        return new Response('', 200);
    }
}
