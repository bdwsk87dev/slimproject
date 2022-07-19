<?php

declare(strict_types=1);

namespace App\Migrations;

use Phoenix\Migration\AbstractMigration;

final class LocationCategoriesTable extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute("CREATE TABLE `location_categories` (
            `lc_code` varchar(100) NOT NULL,
            `lc_name_en` varchar(100) NOT NULL,
            `lc_name_uk` varchar(100) NOT NULL,
            `lc_name_ru` varchar(100) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
            PRIMARY KEY (`lc_code`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
        );
    }

    protected function down(): void
    {
        $this->table('location_categories')
            ->drop();
    }
}
