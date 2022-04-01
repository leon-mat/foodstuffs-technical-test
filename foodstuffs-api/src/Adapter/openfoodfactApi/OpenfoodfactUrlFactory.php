<?php

namespace App\Adapter\openfoodfactApi;

final class OpenfoodfactUrlFactory
{

    public static function generateUrl(string $ean = '', array $allergens = []): string
    {
        $url = 'https://fr.openfoodfacts.org/cgi/search.pl?action=process&json=1';
        $i = 0;

        if ($ean) {
            $url .= '&code='.$ean;
        }
        if (!empty($allergens)) {
            foreach ($allergens as $allergen) {
                $url .= sprintf("&tagtype_%u=allergens&tag_contains_%u=contains&tag_%u=%s", $i, $i, $i, $allergen);
                $i++;
            }
        }

        return $url;
    }
}
