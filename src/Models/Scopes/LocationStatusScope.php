<?php

declare(strict_types=1);

namespace App\Models\Scopes;

use App\Models\LocationStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class LocationStatusScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where(LocationStatus::$fieldIsUndefined, 0);
    }
}
