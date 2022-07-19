<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Scopes\LocationCountryScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class LocationCountry
 *
 * @package App\Models
 * @property int $lc_id
 * @property string $lc_name_en
 * @property string $lc_name_uk
 * @property string $lc_name_ru
 * @property int $lc_is_undefined
 * @property int $lc_is_active
 * @property string $updated_at
 */
class LocationCountry extends Model
{
    public const CODE_UNDEFINED = 1;
    public const CODE_DEFAULT = "UA";

    protected $table = "location_countries";
    protected $primaryKey = "lc_id";
    protected $keyType = "int";

    public static string $fieldIsActive = "lc_is_active";

    protected static function booted()
    {
        static::addGlobalScope(new LocationCountryScope);
    }


    /** -- Relations ----------------------------------------------------------------------------------------------- **/
    public function locations(): HasMany
    {
        return $this->hasMany(Location::class, "f_country_id", "lc_id");
    }

    public function regions(): HasMany
    {
        return $this->hasMany(LocationRegion::class, "f_country_id", "lc_id");
    }

    public function cities(): HasMany
    {
        return $this->hasMany(LocationCity::class, "f_country_id", "lc_id");
    }
    /** // Relations ----------------------------------------------------------------------------------------------- **/


    /** -- Getters ------------------------------------------------------------------------------------------------- **/
    public function getId(): int
    {
        return $this->lc_id;
    }

    public function getName(string $lang): string
    {
        $field = "lc_name_$lang";
        return $this->$field;
    }

    public function getIsUndefined(): int
    {
        return $this->lc_is_undefined;
    }

    public function getIsActive(): int
    {
        return $this->lc_is_active;
    }
    /** // Getters ------------------------------------------------------------------------------------------------- **/
}
