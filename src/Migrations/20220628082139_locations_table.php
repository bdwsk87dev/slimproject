<?php

declare(strict_types=1);

namespace App\Migrations;

use Phoenix\Migration\AbstractMigration;

final class LocationsTable extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute("CREATE TABLE `locations` (
            `l_id` varchar(20) NOT NULL,
            `f_account_id` varchar(21) NOT NULL,
            `l_name` varchar(30) NOT NULL,
            `l_name_full` varchar(61) NOT NULL,
            `l_title` varchar(100) NOT NULL DEFAULT '',
            `l_description` mediumtext,
            `f_status_id` tinyint(1) unsigned NOT NULL DEFAULT '1',
            `l_store_code` mediumint(8) unsigned NOT NULL DEFAULT '0',
            `l_website_url` varchar(255) DEFAULT '',
            `l_labels` varchar(255) DEFAULT '',
            `f_office_status_id` tinyint(1) unsigned NOT NULL DEFAULT '1',
            `l_categories` mediumtext,
            `l_regular_hours` mediumtext,
            `l_phone` mediumtext,
            `l_lat_lng` varchar(100) DEFAULT '',
            `f_country_id` tinyint(3) unsigned NOT NULL DEFAULT '1',
            `f_region_id` smallint(5) unsigned NOT NULL DEFAULT '1',
            `f_city_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
            `l_address` mediumtext,
            `l_metadata` mediumtext,
            `l_logo` varchar(150) DEFAULT '',
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
            PRIMARY KEY (`l_id`),
            KEY `i__f_account_id` (`f_account_id`),
            KEY `i__f_status_id` (`f_status_id`),
            KEY `i__f_office_status_id` (`f_office_status_id`),
            KEY `i__f_country_id` (`f_country_id`),
            KEY `i__f_region_id` (`f_region_id`),
            KEY `i__city_id` (`f_city_id`),
            CONSTRAINT `locations_ibfk_1` FOREIGN KEY (`f_account_id`) REFERENCES `accounts` (`a_id`) ON DELETE CASCADE ON UPDATE NO ACTION
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
        );
    }

    protected function down(): void
    {
        $this->table('locations')
            ->drop();
    }
}
