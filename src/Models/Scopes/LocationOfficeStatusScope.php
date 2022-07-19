<?php

declare(strict_types=1);

namespace App\Models\Scopes;

use App\Models\LocationOfficeStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class LocationOfficeStatusScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where(LocationOfficeStatus::$fieldIsUndefined, 0);
    }
}
