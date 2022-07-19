<?php

declare(strict_types=1);

namespace App\Controllers\Services;

use App\Helpers\ResultHelper;

class SiteMapService
{
    /**
     * Получаем список всех возможных Endpoint-ов
     */
    public static function getIndexData(array $params): string
    {
        $sitemap = config("sitemap");

        if (empty($sitemap)) {
            return ResultHelper::getResultFail("Data for sitemap not found!");
        }

        $result = [];
        $result['get']['main'] = "/{$params['lang']}";

        foreach ($sitemap as $method => $blocks) {
            foreach ($blocks as $route => $pages) {
                $result[$method][$route] = array_map(
                    fn ($page) => rtrim("/{$params['lang']}/$route/$page", "/"), $pages
                );
            }
        }

        return ResultHelper::getResultSuccess($result);
    }
}
