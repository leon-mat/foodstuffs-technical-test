<?php
declare(strict_types=1);

namespace App\Controller;

use App\Adapter\openfoodfactApi\exceptions\FoodStuffNotFound;
use App\Domain\ExclusionOfFoodStuffs\ExclusionOfFoodstuffsRepository;
use App\Domain\foodstuffs\FoodStuffsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//@todo: add JWT to identify users
class ExclusionOfFoodStuffsController extends AbstractController
{
    /**
     * @var FoodStuffsRepository
     */
    private $foodStuffsRepository;
    /**
     * @var ExclusionOfFoodstuffsRepository
     */
    private $exclusionOfFoodstuffsRepository;

    public function __construct(ExclusionOfFoodstuffsRepository $exclusionOfFoodstuffsRepository, FoodStuffsRepository $foodStuffsRepository)
    {
        $this->foodStuffsRepository = $foodStuffsRepository;
        $this->exclusionOfFoodstuffsRepository = $exclusionOfFoodstuffsRepository;
    }

    public function exclude(string $ean)
    {
        try {
            $foodStuff = $this->foodStuffsRepository->getFoodStuffByEan($ean);
        } catch (FoodStuffNotFound $e) {
            throw new NotFoundHttpException('foodstuff not found', $e);
        }
        $this->exclusionOfFoodstuffsRepository->exclude($foodStuff->getEan());

        return new Response('', 200);
    }
}
