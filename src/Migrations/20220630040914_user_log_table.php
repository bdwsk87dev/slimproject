<?php

declare(strict_types=1);

namespace App\Migrations;

use Phoenix\Migration\AbstractMigration;

final class UserLogTable extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute("CREATE TABLE `user_log` (
              `ul_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `ul_user_id` smallint(5) unsigned NOT NULL,
              `ul_type` varchar(20) NOT NULL,
              `ul_table` varchar(100) NOT NULL,
              `ul_field_id` varchar(100) NOT NULL,
              `ul_description` varchar(100) NOT NULL,
              `ul_prev_data` text,
              `ul_new_data` text,
              `ul_ip_address` varbinary(16) NOT NULL,
              `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`ul_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
        );
    }

    protected function down(): void
    {
        $this->table('user_log')
            ->drop();
    }
}
