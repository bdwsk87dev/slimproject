<?php

declare(strict_types=1);

namespace App\Controllers\Services;

use App\Helpers\LinksHelper;
use App\Helpers\ResultHelper;
use App\Models\LocationCity;
use App\Models\LocationCountry;
use App\Models\LocationRegion;
use App\Models\Helpers\LocationChangesHelper;
use App\Models\Helpers\LocationHelper;
use App\Models\Location;
use App\Models\LocationOfficeStatus;
use App\Models\LocationStatus;
use App\Models\MediaFile;
use App\Models\Presenters\LocationCityPresenter;
use App\Models\Presenters\LocationCountryPresenter;
use App\Models\Presenters\LocationRegionPresenter;
use App\Models\Presenters\LocationOfficeStatusPresenter;
use App\Models\Presenters\LocationPresenter;
use App\Models\Presenters\LocationStatusPresenter;
use App\Models\Presenters\MediaFilePresenter;
use App\Models\Presenters\PagingPresenter;
use App\Models\Review;
use Illuminate\Database\Eloquent\Model;

class LocationService
{
    /** -- Locations ----------------------------------------------------------------------------------------------- **/
    /**
     * Получаем список локаций с учетом параметров и пагинации
     */
    public static function getAllData(array $params): string
    {
        $locationsPaging = Location::query()
            ->scopes(["filters" => [$params], "search" => [$params], "paginates" => [$params]]);
        $locations = $locationsPaging->items();

        if (empty($locations)) {
            return ResultHelper::getResultFail("Locations wasn't found!");
        }

        $paging = PagingPresenter::present($locationsPaging, $params);
        $locations = LocationPresenter::presentCollection($locations, $params);

        return ResultHelper::getResultSuccess(['paging' => $paging, 'locations' => $locations]);
    }

    /**
     * Получаем данные по одной локации
     */
    public static function getOneData(Location $location, array $params): string
    {
        $location = LocationPresenter::present($location, $params);

        $reviews = [
            'link' => LinksHelper::getLocationReviewsLink($params['lang'], $location['id']),
            'count' => Review::query()->where(Review::$foreignKey, $location['id'])->count(),
        ];
        $mediaFiles = [
            'link' => LinksHelper::getLocationMediaFilesLink($params['lang'], $location['id']),
            'count' => MediaFile::query()->where(MediaFile::$foreignKey, $location['id'])->count(),
        ];

        return ResultHelper::getResultSuccess([
            'location' => $location,
            'reviews' => $reviews,
            'mediaFiles' => $mediaFiles
        ]);
    }

    /**
     * Получаем данные по одной локации с доп. данными для обновления
     */
    public static function getOneForUpdateData(Location $location, array $params): string
    {
        $location = LocationPresenter::presentUpdate($location, $params);

        $params['type'] = MediaFile::TYPE_OWNER;
        $mediaFiles = MediaFile::query()
            ->scopes(['location' => [$params], 'type' => [$params]])
            ->get()->all();
        $mediaFiles = !empty($mediaFiles) ? MediaFilePresenter::presentUpdateCollection($mediaFiles, $params) : null;

        return ResultHelper::getResultSuccess([
            'location' => $location,
            'mediaFiles' => $mediaFiles,
            'regions' => self::getRegions($params),
            'cities' => self::getCities($params),
            'office_statuses' => self::getOfficeStatuses($params),
        ]);
    }

    /**
     * Получаем одну локацию или null
     */
    public static function getLocationData(array $params): Location|Model|null
    {
        return Location::query()->find($params['id']);
    }

    /**
     * Создаем локацию
     */
    public static function getCreateData(array $params): string
    {
        $result = Location::query()->create(LocationHelper::fillLocationData($params));

        return $result
            ? ResultHelper::getResultSuccess($result)
            : ResultHelper::getResultFail("Location wasn't created!");
    }

    /**
     * Обновляем локацию
     */
    public static function getUpdateData(Location $location, array $params): string
    {
        $location->fill(LocationHelper::fillLocationData($params));
        $result = $location->save();

        return $result
            ? ResultHelper::getResultSuccess($result)
            : ResultHelper::getResultFail("Location wasn't updated!");
    }

    /**
     * Удаляем локацию
     */
    public static function getDeleteData(Location $location, array $params): string
    {
        $isSavedChanges = LocationChangesHelper::fill($location, $params, "delete")->save();
        $result = $isSavedChanges ? $location->delete() : false;

        return $result
            ? ResultHelper::getResultSuccess($result)
            : ResultHelper::getResultFail("Location wasn't deleted!");
    }
    /** // Locations ----------------------------------------------------------------------------------------------- **/


    /** -- Filters ------------------------------------------------------------------------------------------------- **/
    /**
     * Получаем список данных для всех групп фильтров с учетом параметров
     */
    public static function getFiltersData(array $params): string
    {
        $filters = [
            'country' => self::getCountries($params),
            'region' => self::getRegions($params),
            'city' => self::getCities($params),
            'status' => self::getStatuses($params),
            'office_status' => self::getOfficeStatuses($params),
            'search_fields' => self::getSearchFields($params),
        ];

        return ResultHelper::getResultSuccess(['filters' => $filters]);
    }

    /**
     * Получаем список стран с учетом параметров
     */
    private static function getCountries(array $params): array
    {
        $countries = LocationCountry::all()->all();

        return LocationCountryPresenter::presentCollection($countries, $params);
    }

    /**
     * Получаем список регионов с учетом параметров
     */
    private static function getRegions(array $params): array
    {
        $regions = LocationRegion::query()->scopes(['region' => [$params]])->get()->all();

        return LocationRegionPresenter::presentCollection($regions, $params);
    }

    /**
     * Получаем список городов с учетом параметров
     */
    private static function getCities(array $params): array
    {
        $cities = LocationCity::query()->scopes(['city' => [$params]])->get()->all();

        return LocationCityPresenter::presentCollection($cities, $params);
    }

    /**
     * Получаем список статусов локаций с учетом параметров
     */
    private static function getStatuses(array $params): array
    {
        $statuses = LocationStatus::all()->all();

        return LocationStatusPresenter::presentCollection($statuses, $params);
    }
    /**
     * Получаем список статусов отделений с учетом параметров
     */
    private static function getOfficeStatuses(array $params): array
    {
        $statuses = LocationOfficeStatus::all()->all();

        return LocationOfficeStatusPresenter::presentCollection($statuses, $params);
    }

    /**
     * Получаем список полей, по которым будет поиск с учетом параметров
     */
    private static function getSearchFields(array $params): array
    {
        $langLocations = lang("{$params['lang']}/locations");

        return $langLocations['search_field'] ?? [];
    }
    /** // Filters ------------------------------------------------------------------------------------------------- **/
}
