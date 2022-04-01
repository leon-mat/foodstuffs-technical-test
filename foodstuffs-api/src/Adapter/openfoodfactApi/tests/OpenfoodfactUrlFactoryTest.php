<?php

namespace App\Adapter\openfoodfactApi\tests;

use App\Adapter\openfoodfactApi\OpenfoodfactUrlFactory;
use PHPUnit\Framework\TestCase;

final class OpenfoodfactUrlFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_generate_an_openfoodfact_url()
    {
        $this->assertEquals("https://fr.openfoodfacts.org/cgi/search.pl?action=process&json=1&fields=code,product_name_fr,brands,ingredients_text_fr,allergens_from_ingredients,nutriscore_grade", OpenfoodfactUrlFactory::generateUrl());
    }

    /**
     * @test
     */
    public function it_can_generate_an_openfoodfact_url_for_search_an_ean_code()
    {
        $ean = 'myeancode';

        $this->assertEquals("https://fr.openfoodfacts.org/cgi/search.pl?action=process&json=1&code=myeancode&fields=code,product_name_fr,brands,ingredients_text_fr,allergens_from_ingredients,nutriscore_grade", OpenfoodfactUrlFactory::generateUrl($ean));
    }

    /**
     * @test
     */
    public function it_can_generate_an_openfoodfact_url_for_search_allergens()
    {
        $allergens = ['firstAllergen', 'secondAllergen', 'thirdAllergen'];

        $this->assertEquals("https://fr.openfoodfacts.org/cgi/search.pl?action=process&json=1&tagtype_0=allergens&tag_contains_0=contains&tag_0=firstAllergen&tagtype_1=allergens&tag_contains_1=contains&tag_1=secondAllergen&tagtype_2=allergens&tag_contains_2=contains&tag_2=thirdAllergen&fields=code,product_name_fr,brands,ingredients_text_fr,allergens_from_ingredients,nutriscore_grade", OpenfoodfactUrlFactory::generateUrl('', $allergens));
    }

    /**
     * @test
     */
    public function it_can_generate_an_openfoodfact_url_for_search_brand()
    {
        $this->assertEquals("https://fr.openfoodfacts.org/cgi/search.pl?action=process&json=1&tagtype_0=brands&tag_contains_0=contains&tag_0=danone&fields=code,product_name_fr,brands,ingredients_text_fr,allergens_from_ingredients,nutriscore_grade", OpenfoodfactUrlFactory::generateUrl('', [], 'danone'));
    }

    /**
     * @test
     */
    public function it_can_generate_an_openfoodfact_url_for_search_category()
    {
        $this->assertEquals("https://fr.openfoodfacts.org/cgi/search.pl?action=process&json=1&tagtype_0=categories&tag_contains_0=contains&tag_0=cereals&fields=code,product_name_fr,brands,ingredients_text_fr,allergens_from_ingredients,nutriscore_grade", OpenfoodfactUrlFactory::generateUrl('', [], '', 'cereals'));
    }
}
