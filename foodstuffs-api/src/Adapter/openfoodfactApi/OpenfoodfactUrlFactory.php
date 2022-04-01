<?php

namespace App\Adapter\openfoodfactApi;

final class OpenfoodfactUrlFactory
{

    public static function generateUrl(string $ean = '', array $allergens = [], string $brand = '', string $category = ''): string
    {
        $url = 'https://fr.openfoodfacts.org/cgi/search.pl?action=process&json=1';
        $i = 0;

        if ($ean) {
            $url .= '&code='.$ean;
        }
        foreach ($allergens as $allergen) {
            $url .= sprintf("&tagtype_%u=allergens&tag_contains_%u=contains&tag_%u=%s", $i, $i, $i, $allergen);
            $i++;
        }
        if ($brand) {
            $url .= sprintf("&tagtype_%u=brands&tag_contains_%u=contains&tag_%u=%s", $i, $i, $i, $brand);
            $i++;
        }
        if ($category) {
            $url .= sprintf("&tagtype_%u=categories&tag_contains_%u=contains&tag_%u=%s", $i, $i, $i, $category);
            $i++;
        }

        return $url;
    }
}
