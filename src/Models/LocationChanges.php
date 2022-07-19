<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LocationChanges
 *
 * @package App\Models
 * @property int $lch_id
 * @property string $f_location_id
 * @property string $f_location_name
 * @property int $f_user_id
 * @property string $f_user_ip
 * @property string $lch_type
 * @property string $lch_data
 * @property int $lch_is_done
 * @property string $updated_at
 */
class LocationChanges extends Model
{
    protected $table = "location_changes";
    protected $primaryKey = "lch_id";
    protected $keyType = "int";

    public static array $fields = [
        "location_id" => "f_location_id", "location_name" => "f_location_name", "user_id" => "f_user_id",
        "user_ip" => "f_user_ip", "type" => "lch_type", "data" => "lch_data"
    ];

    /** -- Getters ------------------------------------------------------------------------------------------------- **/
    public function getId(): int
    {
        return $this->lch_id;
    }

    public function getLocationId(): string
    {
        return $this->f_location_id;
    }

    public function getLocationName(): string
    {
        return $this->f_location_name;
    }

    public function getUserId(): int
    {
        return $this->f_user_id;
    }

    public function getUserIp(): string
    {
        return $this->f_user_ip;
    }

    public function getType(): string
    {
        return $this->lch_type;
    }

    public function getData(): string
    {
        return $this->lch_data;
    }

    public function getIsDone(): int
    {
        return $this->lch_is_done;
    }
    /** // Getters ------------------------------------------------------------------------------------------------- **/
}
