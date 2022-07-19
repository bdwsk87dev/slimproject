<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class ReviewFilters extends Review
{
    public function search( string $s) : Builder
    {
        $s = str_replace(
            array('%', '_'),
            array('\%', '\_'),
            addslashes(str_replace('\\', '\\\\', $s))
        );

        return $this->builder->where('r_comment', 'like', "%" . $s . "%");
    }

    public function status(int $status_id) : Builder
    {
        if (!$status_id) {
            return $this->builder;
        }

        $operator = $status_id == 1 ? '=' : '!=';

        return $this->builder->where('r_comment_reply', $operator, '');
    }

    public function from(int $timestamp) : Builder
    {
        $s = date('Y-m-d', $timestamp);

        return $this->builder->whereDate('r_time_created', '>=', $s);
    }

    public function to(int $timestamp) : Builder
    {
        $s = date('Y-m-d', $timestamp);

        return $this->builder->whereDate('r_time_created', '<=', $s);
    }

    public function city(int $city_id) : Builder
    {
        return $this->builder->where('f_city_id', '=', $city_id);
    }

    public function region(int $region_id) : Builder
    {
        return $this->builder->where('f_region_id', '=', $region_id);
    }

    public function rating(int $rating_or_comment_id) : Builder
    {
//    Без комментариев, С комментарием,
//    1 - звезда, 2 - звезды, 3 - звезды, 4 - звезды, 5 - звезд,

        if (in_array($rating_or_comment_id, [6,7])) {
            $field = 'r_comment';
            $operator = $rating_or_comment_id == 6 ? '=' : '!=';
            $value = '';
        } elseif (in_array($rating_or_comment_id, [1,2,3,4,5])) {
            $field = 'r_star_rating';
            $operator = '=';
            $value = $rating_or_comment_id;
        } else {
            return $this->builder;
        }

        return $this->builder->where($field, $operator, $value);
    }
}