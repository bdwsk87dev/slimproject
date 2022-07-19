<?php

declare(strict_types=1);

namespace App\Migrations;

use Phoenix\Migration\AbstractMigration;

final class MediaFilesTable extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute("CREATE TABLE `media_files` (
            `mf_id` varchar(100) NOT NULL,
            `f_account_id` varchar(21) NOT NULL,
            `f_location_id` varchar(21) NOT NULL,
            `mf_name` varchar(150) NOT NULL,
            `mf_description` mediumtext,
            `mf_type` varchar(10) DEFAULT '',
            `mf_format` varchar(25) DEFAULT '',
            `mf_category` varchar(30) DEFAULT '',
            `mf_google_url` varchar(150) DEFAULT '',
            `mf_thumbnail_url` varchar(150) DEFAULT '',
            `mf_time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `mf_dimensions` mediumtext,
            `mf_view_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
            `mf_customer` text,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`mf_id`),
            KEY `i__f_location_id` (`f_location_id`),
            KEY `i__f_account_id` (`f_account_id`),
            CONSTRAINT `media_files_ibfk_1` FOREIGN KEY (`f_location_id`) REFERENCES `locations` (`l_id`) ON DELETE CASCADE ON UPDATE NO ACTION
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
        );
    }

    protected function down(): void
    {
        $this->table('media_files')
            ->drop();
    }
}
