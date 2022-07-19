<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Scopes\LocationStatusScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class LocationStatus
 *
 * @package App\Models
 * @property int $ls_id
 * @property string $ls_code
 * @property string $ls_name_en
 * @property string $ls_name_uk
 * @property string $ls_name_ru
 * @property string $updated_at
 */
class LocationStatus extends Model
{
    protected $table = "location_statuses";
    protected $primaryKey = "ls_id";
    protected $keyType = "int";

    public static string $fieldIsUndefined = "ls_is_undefined";

    protected static function booted()
    {
        static::addGlobalScope(new LocationStatusScope);
    }


    /** -- Relations ----------------------------------------------------------------------------------------------- **/
    public function locations(): HasMany
    {
        return $this->HasMany(Location::class, "f_status_id", "ls_id");
    }
    /** // Relations ----------------------------------------------------------------------------------------------- **/

    /** -- Getters ------------------------------------------------------------------------------------------------- **/
    public function getId(): int
    {
        return $this->ls_id;
    }

    public function getCode(): string
    {
        return $this->ls_code;
    }

    public function getName(string $lang): string
    {
        $field = "ls_name_$lang";
        return $this->$field;
    }
    /** // Getters ------------------------------------------------------------------------------------------------- **/
}
