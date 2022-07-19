<?php

declare(strict_types=1);

namespace App\Models\Scopes;

use App\Models\LocationRegion;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class LocationRegionScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where(LocationRegion::$fieldIsActive, 1);
    }
}
