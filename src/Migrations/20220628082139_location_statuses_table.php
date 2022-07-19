<?php

declare(strict_types=1);

namespace App\Migrations;

use Phoenix\Migration\AbstractMigration;

final class LocationStatusesTable extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute("CREATE TABLE `location_statuses` (
            `ls_id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
            `ls_code` varchar(20) NOT NULL,
            `ls_name_en` varchar(30) DEFAULT '',
            `ls_name_uk` varchar(30) DEFAULT '',
            `ls_name_ru` varchar(30) DEFAULT '',
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
            PRIMARY KEY (`ls_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
        );
    }

    protected function down(): void
    {
        $this->table('location_statuses')
            ->drop();
    }
}
