<?php

namespace App\Adapter\openfoodfactApi;

final class OpenfoodfactUrlFactory
{

    public static function generateUrl(): string
    {
        return 'https://fr.openfoodfacts.org/cgi/search.pl?action=process&json=1';
    }
}
