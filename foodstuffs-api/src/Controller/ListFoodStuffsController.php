<?php

namespace App\Controller;

use App\Domain\foodstuffs\FoodStuff;
use App\Domain\foodstuffs\FoodStuffsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListFoodStuffsController extends AbstractController
{
    /**
     * @var FoodStuffsRepository
     */
    private $foodStuffsRepository;

    public function __construct(FoodStuffsRepository $foodStuffsRepository)
    {
        $this->foodStuffsRepository = $foodStuffsRepository;
    }

    public function search(Request $request): Response
    {
        $foodstuffs = $this->foodStuffsRepository->search('', [], '', '', '');

        $responseData = $this->transformFoodStuffsToArray($foodstuffs);

        return JsonResponse::fromJsonString(\json_encode($responseData));
    }

    /**
     * @param FoodStuff[] $foodstuffs
     *
     * @return array
     */
    private function transformFoodStuffsToArray(array $foodstuffs)
    {
        $responseData = [];

        foreach ($foodstuffs as $foodstuff) {
            $responseData[] = [
                'ean' => $foodstuff->getEan()
            ];
        }

        return $responseData;
    }
}
