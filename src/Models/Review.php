<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Review
 *
 * @package App\Models
 * @property string $r_id
 * @property string $f_location_id
 * @property string $r_name
 * @property string $r_comment
 * @property int $r_star_rating
 * @property string $r_time_created
 * @property string $r_time_updated
 * @property string $r_reviewer_photo
 * @property string $r_reviewer_name
 * @property string $r_comment_reply
 * @property string $r_time_reply
 * @property string $updated_at
 */
class Review extends Model
{
    protected $table = "reviews";
    protected $primaryKey = "r_id";
    protected Builder $builder;

    public $incrementing = false;

    public static string $foreignKey = "f_location_id";


    /** -- Scopes -------------------------------------------------------------------------------------------------- **/
    public function scopeFilters(Builder $query, array $params): Builder
    {
        $this->builder = $query;

        foreach ($params as $name => $value) {
            if (method_exists($this, $name)) {
                call_user_func_array([$this, $name], [$value]);
            }
        }

        return $this->builder;
    }
    /** // Scopes -------------------------------------------------------------------------------------------------- **/


    /** -- Getters ------------------------------------------------------------------------------------------------- **/
    public function getId(): string
    {
        return $this->r_id;
    }

    public function getLocationId(): string
    {
        return $this->f_location_id;
    }

    public function getName(): string
    {
        return $this->r_name;
    }

    public function getComment(): string
    {
        return $this->r_comment;
    }

    public function getStarRating(): int
    {
        return $this->r_star_rating;
    }

    public function getTimeCreated(): string
    {
        return $this->r_time_created;
    }

    public function getTimeUpdated(): string
    {
        return $this->r_time_updated;
    }

    public function getReviewerPhoto(): string
    {
        return $this->r_reviewer_photo;
    }

    public function getReviewerName(): string
    {
        return $this->r_reviewer_name;
    }

    public function getCommentReply(): string
    {
        return $this->r_comment_reply;
    }

    public function getTimeReply(): string
    {
        return $this->r_time_reply;
    }
    /** // Getters ------------------------------------------------------------------------------------------------- **/
}
