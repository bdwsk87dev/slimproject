<?php

declare(strict_types=1);

namespace App\Migrations;

use Phoenix\Migration\AbstractMigration;

final class LocationOfficeStatusesTable extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute("CREATE TABLE `location_office_statuses` (
            `los_id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
            `los_code` varchar(20) NOT NULL,
            `los_name_en` varchar(30) DEFAULT '',
            `los_name_uk` varchar(30) DEFAULT '',
            `los_name_ru` varchar(30) DEFAULT '',
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
            PRIMARY KEY (`los_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
        );
    }

    protected function down(): void
    {
        $this->table('location_office_statuses')
            ->drop();
    }
}
