<?php

declare(strict_types=1);

namespace App\Models\Helpers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorAlias;

class PagingHelper
{
    public static function getPagingData(LengthAwarePaginatorAlias $item, array $params): array
    {
        return [
            'per_page' => self::getPerPage($item),
            'curr_page' => self::getCurrPage($item),
            'last_page' => self::getLastPage($item),
            'total_items' => self::getTotalItems($item),
        ];
    }

    private static function getPerPage(LengthAwarePaginatorAlias $item): int
    {
        return $item->perPage();
    }

    private static function getCurrPage(LengthAwarePaginatorAlias $item): int
    {
        return $item->currentPage();
    }

    private static function getLastPage(LengthAwarePaginatorAlias $item): int
    {
        return $item->lastPage();
    }

    private static function getTotalItems(LengthAwarePaginatorAlias $item): int
    {
        return $item->total();
    }
}
