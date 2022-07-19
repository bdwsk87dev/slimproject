<?php

declare(strict_types=1);

namespace App\Helpers;

class LinksHelper
{
    public static function getLocationReviewsLink(string $lang, string $locationId): string
    {
        return "/$lang/locations/$locationId/reviews";
    }

    public static function getLocationMediaFilesLink(string $lang, string $locationId): string
    {
        return "/$lang/locations/$locationId/media-files";
    }
}
