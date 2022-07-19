<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Filters\LocationFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorAlias;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Location
 *
 * @package App\Models
 * @property string $l_id
 * @property string $l_name_full
 * @property string $l_title
 * @property string $l_description
 * @property int $l_store_code
 * @property string $l_website_url
 * @property string $l_labels
 * @property string $l_categories
 * @property string $l_regular_hours
 * @property string $l_phone
 * @property string $l_lat_lng
 * @property string $l_address
 * @property string $l_metadata
 * @property string $l_logo
 * @property LocationOfficeStatus $officeStatus
 * @property LocationStatus $status
 * @property LocationCountry $country
 * @property LocationRegion $region
 * @property LocationCity $city
 * @property string $updated_at
 */
class Location extends Model
{
    protected $table = "locations";
    protected $primaryKey = "l_id";
    protected $keyType = "string";

    public $incrementing = false;


    /** -- Relations ----------------------------------------------------------------------------------------------- **/
    public function officeStatus(): BelongsTo
    {
        return $this->belongsTo(LocationOfficeStatus::class, "f_office_status_id", "los_id");
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(LocationStatus::class, "f_status_id", "ls_id");
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(LocationCountry::class, "f_country_id", "lc_id");
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(LocationRegion::class, "f_region_id", "lr_id");
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(LocationCity::class, "f_city_id", "lc_id");
    }
    /** // Relations ----------------------------------------------------------------------------------------------- **/


    /** -- Scopes -------------------------------------------------------------------------------------------------- **/
    public function scopeFilters(Builder $query, $params): Builder
    {
        $filtersParams = LocationFilter::getFiltersParams($params);

        return !empty($filtersParams) ? $query->where($filtersParams) : $query;
    }

    public function scopeSearch(Builder $query, $params): Builder
    {
        $searchParams = LocationFilter::getSearchParams($params);

        return !empty($searchParams) ? $query->where(...$searchParams) : $query;
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
        return $this->l_id;
    }

    public function getName(): string
    {
        return $this->l_name_full;
    }

    public function getTitle(): string
    {
        return $this->l_title;
    }

    public function getDescription(): string
    {
        return $this->l_description;
    }

    public function getStoreCode(): int
    {
        return $this->l_store_code;
    }

    public function getWebsiteUrl(): string
    {
        return $this->l_website_url;
    }

    public function getLabels(): string
    {
        return $this->l_labels;
    }

    public function getCategories(): string
    {
        return $this->l_categories;
    }

    public function getRegularHours(): string
    {
        return $this->l_regular_hours;
    }

    public function getPhone(): string
    {
        return $this->l_phone;
    }

    public function getLatLng(): string
    {
        return $this->l_lat_lng;
    }

    public function getAddress(): string
    {
        return $this->l_address;
    }

    public function getMetadata(): string
    {
        return $this->l_metadata;
    }

    public function getLogo(): string
    {
        return $this->l_logo;
    }

    public function getOfficeStatus(): LocationOfficeStatus
    {
        return $this->officeStatus;
    }

    public function getStatus(): LocationStatus
    {
        return $this->status;
    }

    public function getCountry(): LocationCountry
    {
        return $this->country;
    }

    public function getRegion(): LocationRegion
    {
        return $this->region;
    }

    public function getCity(): LocationCity
    {
        return $this->city;
    }
    /** // Getters ------------------------------------------------------------------------------------------------- **/
}
