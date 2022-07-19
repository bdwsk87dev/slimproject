<?php

declare(strict_types=1);

namespace App\Migrations;

use Phoenix\Migration\AbstractMigration;

final class ReviewsTable extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute("CREATE TABLE `reviews` (
            `r_id` varchar(100) NOT NULL,
            `f_account_id` varchar(21) NOT NULL,
            `f_location_id` varchar(21) NOT NULL,
            `r_name` varchar(161) NOT NULL,
            `r_comment` text,
            `r_star_rating` tinyint(1) unsigned NOT NULL DEFAULT '0',
            `r_time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `r_time_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `r_reviewer_photo` mediumtext,
            `r_reviewer_name` varchar(100) DEFAULT '',
            `r_comment_reply` text,
            `r_time_reply` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`r_id`),
            KEY `i__f_location_id` (`f_location_id`),
            KEY `i__f_account_id` (`f_account_id`),
            CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`f_location_id`) REFERENCES `locations` (`l_id`) ON DELETE CASCADE ON UPDATE NO ACTION
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
        );
    }

    protected function down(): void
    {
        $this->table('reviews')
            ->drop();
    }
}
