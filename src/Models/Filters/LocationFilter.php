<?php

declare(strict_types=1);

namespace App\Models\Filters;

class LocationFilter
{
    private static array $filterFields = [
        "country" => "f_country_id", "region" => "f_region_id", "city" => "f_city_id", "status" => "f_status_id",
        "office_status" => "f_office_status_id",
    ];
    private static array $searchFields = [
        "store_code" => "l_store_code", "title" => "l_title", "address" => "l_address"
    ];
    private static array $searchOperators = ["store_code" => "=", "title" => "like", "address" => "like"];

    public static function getFiltersParams($params): array
    {
        $filtersParams = [];
        $filters = array_intersect(array_keys(self::$filterFields), array_keys($params));

        if (!empty($filters)) {
            $filtersParams = array_map(fn ($filter) => [self::$filterFields[$filter], $params[$filter]], $filters);
        }

        return $filtersParams;
    }

    public static function getSearchParams($params): array
    {
        $searchParams = [];

        $searchField = $params['search_field'] ?? "";
        $searchText = $params['search_text'] ?? "";

        if ($searchField && $searchText) {
            $searchOperator = self::$searchOperators[$searchField];
            $searchValue = ($searchOperator == "like") ? "%".self::escapeLike($searchText)."%" : $searchText;
            $searchParams = [self::$searchFields[$searchField], $searchOperator, $searchValue];
        }

        return $searchParams;
    }

    private static function escapeLike(string $value): string
    {
        return str_replace(
            ["\\", "%", "_"],
            ["\\\\", "\\%", "\\_"],
            $value
        );
    }
}