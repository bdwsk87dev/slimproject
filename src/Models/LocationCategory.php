<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LocationCategory
 *
 * @package App\Models
 * @property string $lc_code
 * @property string $lc_name_en
 * @property string $lc_name_uk
 * @property string $lc_name_ru
 * @property string $updated_at
 */
class LocationCategory extends Model
{
    public const CODE_PRIMARY_DEFAULT = "logistics_service";
    public const CODE_ADDITIONAL_DEFAULT = "shipping_and_mailing_service";

    protected $table = "location_categories";
    protected $primaryKey = "lc_code";
    protected $keyType = "string";


    /** -- Getters ------------------------------------------------------------------------------------------------- **/
    public function getCode(): string
    {
        return $this->lc_code;
    }

    public function getName(string $lang): string
    {
        $field = "lc_name_$lang";
        return $this->$field;
    }
    /** // Getters ------------------------------------------------------------------------------------------------- **/
}