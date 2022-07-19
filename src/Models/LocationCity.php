<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Scopes\LocationCityScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class LocationCity
 *
 * @package App\Models
 * @property int $lc_id
 * @property int $f_country_id
 * @property int $f_region_id
 * @property string $lc_name
 * @property string $lc_name_en
 * @property string $lc_name_uk
 * @property string $lc_name_ru
 * @property int $lc_is_active
 * @property string $updated_at
 */
class LocationCity extends Model
{
    protected $table = "location_cities";
    protected $primaryKey = "lc_id";
    protected $keyType = "int";

    private static array $filters = ["country" => "f_country_id", "region" => "f_region_id"];

    public static string $fieldIsActive = "lc_is_active";

    protected static function booted()
    {
        static::addGlobalScope(new LocationCityScope);
    }


    /** -- Relations ----------------------------------------------------------------------------------------------- **/
    public function locations(): hasMany
    {
        return $this->hasMany(Location::class, "f_city_id", "lc_id");
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(LocationCountry::class, "f_country_id", "lc_id");
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(LocationRegion::class, "f_region_id", "lr_id");
    }
    /** // Relations ----------------------------------------------------------------------------------------------- **/


    /** -- Scopes -------------------------------------------------------------------------------------------------- **/
    public function scopeCity(Builder $query, $params): Builder
    {
        return (isset($params['region'])
            ? $query->where(self::$filters['region'], $params['region'])
            : (isset($params['country']) ? $query->where(self::$filters['country'], $params['country']) : $query))
            ->orderBy("lc_name");
    }
    /** // Scopes -------------------------------------------------------------------------------------------------- **/


    /** -- Getters ------------------------------------------------------------------------------------------------- **/
    public function getId(): int
    {
        return $this->lc_id;
    }

    public function getCountryId(): int
    {
        return $this->f_country_id;
    }

    public function getRegionId(): int
    {
        return $this->f_region_id;
    }

    public function getName(): string
    {
        return $this->lc_name;
    }

    public function getNameLang(string $lang): string
    {
        $field = "lc_name_$lang";
        return $this->$field;
    }

    public function getIsActive(): int
    {
        return $this->lc_is_active;
    }
    /** // Getters ------------------------------------------------------------------------------------------------- **/
}
