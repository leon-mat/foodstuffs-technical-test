<?php

namespace App\Adapter\openfoodfactApi\tests;

use App\Adapter\openfoodfactApi\OpenfoodfactUrlFactory;
use PHPUnit\Framework\TestCase;

final class OpenfoodfactUrlFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_create_an_openfoodfact_url()
    {
        $this->assertEquals("https://fr.openfoodfacts.org/cgi/search.pl?action=process&json=1", OpenfoodfactUrlFactory::generateUrl());
    }
}
