<?php

declare(strict_types=1);

namespace App\Models\Presenters;

use App\Models\Helpers\PagingHelper;

class PagingPresenter implements DefaultPresenter
{
    public static function present(mixed $item, array $params): array
    {
        $data = PagingHelper::getPagingData($item, $params);

        return [
            'per_page' => $data['per_page'],
            'curr_page' => $data['curr_page'],
            'last_page' => $data['last_page'],
            'total_items' => $data['total_items'],
        ];
    }
}
