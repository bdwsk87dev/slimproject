<?php

declare(strict_types=1);

namespace App\Migrations;

use Phoenix\Migration\AbstractMigration;

final class LocationChangesTable extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute("CREATE TABLE `location_changes` (
            `lch_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
            `f_location_id` varchar(21) NOT NULL,
            `f_location_name` varchar(61) NOT NULL,
            `f_user_id` smallint(5) unsigned NOT NULL DEFAULT '1',
            `f_user_ip` varbinary(16) NOT NULL,
            `lch_type` enum('insert','update','delete') DEFAULT NULL,
            `lch_data` text,
            `lch_is_done` tinyint(1) unsigned NOT NULL DEFAULT '0',
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
            PRIMARY KEY (`lch_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
        );
    }

    protected function down(): void
    {
        $this->table('location_changes')
            ->drop();
    }
}
