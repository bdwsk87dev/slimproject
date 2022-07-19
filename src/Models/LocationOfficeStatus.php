<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Scopes\LocationOfficeStatusScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class LocationOfficeStatus
 *
 * @package App\Models
 * @property int $los_id
 * @property string $los_code
 * @property string $los_name_en
 * @property string $los_name_uk
 * @property string $los_name_ru
 * @property string $updated_at
 */
class LocationOfficeStatus extends Model
{
    protected $table = "location_office_statuses";
    protected $primaryKey = "los_id";
    protected $keyType = "int";

    public static string $fieldIsUndefined = "los_is_undefined";

    protected static function booted()
    {
        static::addGlobalScope(new LocationOfficeStatusScope);
    }


    /** -- Relations ----------------------------------------------------------------------------------------------- **/
    public function locations(): HasMany
    {
        return $this->HasMany(Location::class, "f_office_status_id", "los_id");
    }
    /** // Relations ----------------------------------------------------------------------------------------------- **/

    /** -- Getters ------------------------------------------------------------------------------------------------- **/
    public function getId(): int
    {
        return $this->los_id;
    }

    public function getCode(): string
    {
        return $this->los_code;
    }

    public function getName(string $lang): string
    {
        $field = "los_name_$lang";
        return $this->$field;
    }
    /** // Getters ------------------------------------------------------------------------------------------------- **/
}
