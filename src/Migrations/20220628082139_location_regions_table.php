<?php

declare(strict_types=1);

namespace App\Migrations;

use Phoenix\Migration\AbstractMigration;

final class LocationRegionsTable extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute("CREATE TABLE `location_regions` (
            `lr_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
            `f_country_id` tinyint(3) unsigned NOT NULL,
            `lr_name_en` varchar(30) DEFAULT '',
            `lr_name_uk` varchar(30) DEFAULT '',
            `lr_name_ru` varchar(30) DEFAULT '',
            `lr_name_translit` varchar(30) DEFAULT '',
            `lr_name_en_ru` varchar(30) DEFAULT '',
            `lr_is_undefined` tinyint(1) unsigned NOT NULL DEFAULT '0',
            `lr_is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
            PRIMARY KEY (`lr_id`),
            KEY `i__f_country_id` (`f_country_id`),
            CONSTRAINT `location_regions_ibfk_1` FOREIGN KEY (`f_country_id`) REFERENCES `location_countries` (`lc_id`) ON DELETE CASCADE ON UPDATE NO ACTION
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
        );
    }

    protected function down(): void
    {
        $this->table('location_regions')
            ->drop();
    }
}
