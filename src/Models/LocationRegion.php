<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Scopes\LocationRegionScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class LocationRegion
 *
 * @package App\Models
 * @property int $lr_id
 * @property int $f_country_id
 * @property string $lr_name_en
 * @property string $lr_name_uk
 * @property string $lr_name_ru
 * @property int $lr_is_undefined
 * @property int $lr_is_active
 * @property string $updated_at
 */
class LocationRegion extends Model
{
    public const REGION_UNDEFINED = 1;

    protected $table = "location_regions";
    protected $primaryKey = "lr_id";
    protected $keyType = "int";

    private static array $filters = ["country" => "f_country_id"];

    public static string $fieldIsActive = "lr_is_active";

    protected static function booted()
    {
        static::addGlobalScope(new LocationRegionScope);
    }


    /** -- Relations ----------------------------------------------------------------------------------------------- **/
    public function locations(): hasMany
    {
        return $this->hasMany(Location::class, "f_region_id", "lr_id");
    }

    public function cities(): HasMany
    {
        return $this->hasMany(LocationCity::class, "f_region_id", "lr_id");
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(LocationCountry::class, "f_country_id", "lc_id");
    }
    /** // Relations ----------------------------------------------------------------------------------------------- **/


    /** -- Scopes -------------------------------------------------------------------------------------------------- **/
    public function scopeRegion(Builder $query, $params): Builder
    {
        /* if more than one country
         * return isset($params['country']) ? $query->where(self::$filters['country'], $params['country']) : $query;
         * */
        return isset($params['country'])
            ? $query->whereIn(self::$filters['country'], [LocationCountry::CODE_UNDEFINED, $params['country']])
            : $query;
    }
    /** // Scopes -------------------------------------------------------------------------------------------------- **/


    /** -- Getters ------------------------------------------------------------------------------------------------- **/
    public function getId(): int
    {
        return $this->lr_id;
    }

    public function getCountryId(): int
    {
        return $this->f_country_id;
    }

    public function getName(string $lang): string
    {
        $field = "lr_name_$lang";
        return $this->$field;
    }

    public function getIsUndefined(): int
    {
        return $this->lr_is_undefined;
    }

    public function getIsActive(): int
    {
        return $this->lr_is_active;
    }
    /** // Getters ------------------------------------------------------------------------------------------------- **/
}
