<?php

declare(strict_types=1);

namespace App\Models\Presenters;

interface DefaultPresenter
{
    public static function present(mixed $item, array $params): array;
}
