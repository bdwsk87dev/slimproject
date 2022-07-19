<?php

declare(strict_types=1);

namespace App\Migrations;

use Phoenix\Migration\AbstractMigration;

final class LocationCitiesTable extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute("CREATE TABLE `location_cities` (
            `lc_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
            `f_country_id` tinyint(3) unsigned NOT NULL,
            `f_region_id` smallint(5) unsigned DEFAULT '0',
            `lc_name` varchar(100) NOT NULL,
            `lc_name_en` varchar(100) DEFAULT '',
            `lc_name_uk` varchar(100) DEFAULT '',
            `lc_name_ru` varchar(100) DEFAULT '',
            `lc_is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
            PRIMARY KEY (`lc_id`),
            UNIQUE KEY `i__city_unique` (`f_country_id`,`f_region_id`,`lc_name`),
            KEY `i__f_country_id` (`f_country_id`),
            KEY `i__f_region_id` (`f_region_id`),
            CONSTRAINT `location_cities_ibfk_1` FOREIGN KEY (`f_region_id`) REFERENCES `location_regions` (`lr_id`) ON DELETE CASCADE ON UPDATE NO ACTION
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
        );
    }

    protected function down(): void
    {
        $this->table('location_cities')
            ->drop();
    }
}
