<?php

namespace App\Adapter\openfoodfactApi\tests;

use App\Adapter\openfoodfactApi\FoodStuffsFromOpenfoodfactApi;
use App\Adapter\openfoodfactApi\OpenfoodfactUrlFactory;
use App\Domain\foodstuffs\FoodStuff;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

final class FoodStuffsFromOpenfoodfactApiTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_search_foodstuffs_by_ean()
    {
        $ean = '3057640257773';

        $repository = new FoodStuffsFromOpenfoodfactApi($this->createHttpClientMock(OpenfoodfactUrlFactory::generateUrl($ean), '/fixtures/openfoodfact_api_response_1_ean_volvic.json'));

        $this->assertEquals([new FoodStuff('3057640257773')], $repository->search('', [], $ean, '', ''));
    }

    /**
     * @return HttpClientInterface|MockObject
     */
    private function createHttpClientMock(string $url, string $pathToFixtureReponse): HttpClientInterface
    {
        $response = $this->createMock(ResponseInterface::class);
        $response->method('getContent')
                    ->willReturn(file_get_contents(__DIR__.$pathToFixtureReponse));

        $httpClient = $this->createMock(HttpClientInterface::class);
        $httpClient->method('request')
                           ->with('GET', $url)
                           ->willReturn($response);

        return $httpClient;
    }
}
