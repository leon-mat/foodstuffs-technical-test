<?php

namespace App\Adapter\openfoodfactApi;

final class OpenfoodfactUrlFactory
{

    public static function generateUrl(string $ean = ''): string
    {
        if ($ean) {
            return 'https://fr.openfoodfacts.org/cgi/search.pl?action=process&code='.$ean.'&json=1';
        } else {
            return 'https://fr.openfoodfacts.org/cgi/search.pl?action=process&json=1';
        }
    }
}
