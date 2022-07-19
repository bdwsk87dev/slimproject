<?php

declare(strict_types=1);

namespace App\Models\Scopes;

use App\Models\LocationCountry;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class LocationCountryScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where(LocationCountry::$fieldIsActive, 1);
    }
}
