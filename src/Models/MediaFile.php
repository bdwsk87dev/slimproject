<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorAlias;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MediaFile
 *
 * @package App\Models
 * @property string $mf_id
 * @property string $f_location_id
 * @property string $mf_name
 * @property string $mf_description
 * @property string $mf_type
 * @property string $mf_format
 * @property string $mf_category
 * @property string $mf_google_url
 * @property string $mf_thumbnail_url
 * @property string $mf_time_created
 * @property int $mf_view_count
 * @property string $mf_customer
 * @property string $updated_at
 */
class MediaFile extends Model
{
    public const TYPE_OWNER = "OWNER";

    protected $table = "media_files";
    protected $primaryKey = "mf_id";
    protected $fillable = ["mf_description", "mf_type", "mf_format", "mf_category",];

    public $incrementing = false;

    public static string $foreignKey = "f_location_id";
    public static string $fieldType = "mf_type";


    /** -- Scopes -------------------------------------------------------------------------------------------------- **/
    public function scopeLocation(Builder $query, array $params): Builder
    {
        return $query
            ->where(self::$foreignKey, $params['id']);
    }

    public function scopeType(Builder $query, array $params): Builder
    {
        return $query
            ->where(self::$fieldType, $params['type']);
    }

    public function scopePaginates(Builder $query, array $params): LengthAwarePaginatorAlias
    {
        return $query
            ->orderBy($params['field'], $params['order'])
            ->paginate($params['per_page'], ["*"], null, $params['page']);
    }
    /** // Scopes -------------------------------------------------------------------------------------------------- **/


    /** -- Getters ------------------------------------------------------------------------------------------------- **/
    public function getId(): string
    {
        return $this->mf_id;
    }

    public function getLocationId(): string
    {
        return $this->f_location_id;
    }

    public function getName(): string
    {
        return $this->mf_name;
    }

    public function getDescription(): string
    {
        return $this->mf_description;
    }

    public function getType(): string
    {
        return $this->mf_type;
    }

    public function getFormat(): string
    {
        return $this->mf_format;
    }

    public function getCategory(): string
    {
        return $this->mf_category;
    }

    public function getGoogleUrl(): string
    {
        return $this->mf_google_url;
    }

    public function getThumbnailUrl(): string
    {
        return $this->mf_thumbnail_url;
    }

    public function getTimeCreated(): string
    {
        return $this->mf_time_created;
    }

    public function getViewCount(): int
    {
        return $this->mf_view_count;
    }

    public function getCustomer(): string
    {
        return $this->mf_customer;
    }
    /** // Getters ------------------------------------------------------------------------------------------------- **/
}
