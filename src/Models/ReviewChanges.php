<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReviewChanges
 *
 * @package App\Models
 * @property int $rch_id
 * @property string $f_review_id
 * @property string $f_review_name
 * @property int $f_user_id
 * @property string $f_user_ip
 * @property string $rch_type
 * @property string $rch_data
 * @property int $rch_is_done
 * @property string $updated_at
 */
class ReviewChanges extends Model
{
    protected $table = "review_changes";
    protected $primaryKey = "rch_id";
    protected $keyType = "int";

    public static array $fields = [
        "review_id" => "f_review_id", "review_name" => "f_review_name", "user_id" => "f_user_id",
        "user_ip" => "f_user_ip", "type" => "rch_type", "data" => "rch_data"
    ];

    /** -- Getters ------------------------------------------------------------------------------------------------- **/
    public function getId(): int
    {
        return $this->rch_id;
    }

    public function getReviewId(): string
    {
        return $this->f_review_id;
    }

    public function getReviewName(): string
    {
        return $this->f_review_name;
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
        return $this->rch_type;
    }

    public function getData(): string
    {
        return $this->rch_data;
    }

    public function getIsDone(): int
    {
        return $this->rch_is_done;
    }
    /** // Getters ------------------------------------------------------------------------------------------------- **/
}
