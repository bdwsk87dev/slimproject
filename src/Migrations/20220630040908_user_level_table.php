<?php

declare(strict_types=1);

namespace App\Migrations;

use Phoenix\Migration\AbstractMigration;

final class UserLevelTable extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute("CREATE TABLE `user_level` (
              `ul_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
              `ul_type` varchar(20) NOT NULL,
              `ul_name_en` varchar(100) NOT NULL,
              `ul_name_uk` varchar(100) NOT NULL,
              `ul_name_ru` varchar(100) NOT NULL,
              `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`ul_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
        );
    }

    protected function down(): void
    {
        $this->table('user_level')
            ->drop();
    }
}
