<?php

declare(strict_types=1);

namespace App\Controllers\Services;

use App\Helpers\ResultHelper;
use App\Models\Helpers\MediaFileHelper;
use App\Models\MediaFile;
use App\Models\Presenters\MediaFilePresenter;
use App\Models\Presenters\PagingPresenter;
use Illuminate\Database\Eloquent\Model;

class MediaFileService
{
    /** -- MediaFiles ---------------------------------------------------------------------------------------------- **/
    /**
     * Получаем список медиа файлов с учетом пагинации
     */
    public static function getAllData(array $params): string
    {
        $mediaFilesPaging = MediaFile::query()
            ->scopes(["paginates" => [$params]]);
        $mediaFiles = $mediaFilesPaging->items();

        if (empty($mediaFiles)) {
            return ResultHelper::getResultFail("Media files wasn't found!");
        }

        $paging = PagingPresenter::present($mediaFilesPaging, $params);
        $mediaFiles = MediaFilePresenter::presentCollection($mediaFiles, $params);

        return ResultHelper::getResultSuccess(['paging' => $paging, 'mediaFiles' => $mediaFiles]);
    }

    /**
     * Получаем данные по одному медиа файлу
     */
    public static function getOneData(MediaFile $mediaFile, array $params): string
    {
        $mediaFile = MediaFilePresenter::present($mediaFile, $params);

        return ResultHelper::getResultSuccess(['mediaFile' => $mediaFile]);
    }

    /**
     * Получаем однин медиа файл или null
     */
    public static function getMediaFileData(array $params): MediaFile|Model|null
    {
        return MediaFile::query()->find($params['id']);
    }

    /**
     * Получаем список медиа файлов для конкретной локации
     */
    public static function getAllByLocationIdData(array $params): string
    {
        $mediaFiles = MediaFile::query()
            ->scopes(["location" => [$params], "paginates" => [$params]])
            ->items();

        if (empty($mediaFiles)) {
            return ResultHelper::getResultFail("Media files wasn't found!");
        }

        $mediaFiles = MediaFilePresenter::presentCollection($mediaFiles, $params);

        return ResultHelper::getResultSuccess(['mediaFiles' => $mediaFiles]);
    }

    /**
     * Создаем медиа файл
     */
    public static function getCreateData(array $params): string
    {
        $result = MediaFile::query()->create(MediaFileHelper::fillMediaFileData($params));

        return $result
            ? ResultHelper::getResultSuccess($result)
            : ResultHelper::getResultFail("Media file wasn't created!");
    }

    /**
     * Обновляем медиа файл
     */
    public static function getUpdateData(MediaFile $location, array $params): string
    {
        $location->fill(MediaFileHelper::fillMediaFileData($params));
        $result = $location->save();

        return $result
            ? ResultHelper::getResultSuccess($result)
            : ResultHelper::getResultFail("Media file wasn't updated!");
    }

    /**
     * Удаляем медиа файл
     */
    public static function getDeleteData(MediaFile $mediaFile): string
    {
        $result = $mediaFile->delete();

        return $result
            ? ResultHelper::getResultSuccess($result)
            : ResultHelper::getResultFail("Media file wasn't deleted!");
    }
    /** // MediaFiles ---------------------------------------------------------------------------------------------- **/
}