<?php

declare(strict_types=1);

namespace App\Migrations;

use Phoenix\Migration\AbstractMigration;

final class ReviewChangesTable extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute("CREATE TABLE `review_changes` (
            `rch_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
            `f_location_id` varchar(21) NOT NULL,
            `f_location_name` varchar(61) NOT NULL,
            `f_user_id` smallint(5) unsigned NOT NULL DEFAULT '1',
            `f_user_ip` varbinary(16) NOT NULL,
            `rch_type` enum('insert','update','delete') DEFAULT NULL,
            `rch_data` text,
            `rch_is_done` tinyint(1) unsigned NOT NULL DEFAULT '0',
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
            PRIMARY KEY (`rch_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
        );
    }

    protected function down(): void
    {
        $this->table('review_changes')
            ->drop();
    }
}
