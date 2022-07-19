<?php

declare(strict_types=1);

namespace App\Migrations;

use Phoenix\Migration\AbstractMigration;

final class LocationCountriesTable extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute("CREATE TABLE `location_countries` (
            `lc_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
            `lc_code` char(2) NOT NULL,
            `lc_name_en` varchar(30) DEFAULT '',
            `lc_name_uk` varchar(30) DEFAULT '',
            `lc_name_ru` varchar(30) DEFAULT '',
            `lc_is_undefined` tinyint(1) unsigned NOT NULL DEFAULT '0',
            `lc_is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
            PRIMARY KEY (`lc_id`),
            KEY `i__lc_code` (`lc_code`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
        );
    }

    protected function down(): void
    {
        $this->table('location_countries')
            ->drop();
    }
}
