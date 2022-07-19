<?php

declare(strict_types=1);

namespace App\Models\Helpers;

use Illuminate\Support\Collection;

class ReviewHelper
{
    public static function transformCollection(mixed $data): Collection
    {
        return Collection::make($data)
            ->transform(function ($item, $key) {
                $item->l_address = json_decode($item->l_address, true);
                $item->l_metadata = json_decode($item->l_metadata, true);
                return $item;
            });
    }
}
