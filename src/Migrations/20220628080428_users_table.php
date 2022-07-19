<?php

declare(strict_types=1);

namespace App\Migrations;

use Phoenix\Migration\AbstractMigration;

final class UsersTable extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute("CREATE TABLE `users` (
            `u_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
            `u_email` varchar(50) NOT NULL,
            `u_password` varchar(100) NOT NULL,
            `u_first_name` varchar(100) NOT NULL,
            `u_last_name` varchar(100) NOT NULL,
            `u_middle_name` varchar(100) DEFAULT '',
            `u_phone` varchar(50) DEFAULT '',
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`u_id`),
            UNIQUE KEY `i__u_email` (`u_email`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
        );
    }

    protected function down(): void
    {
        $this->table('users')
            ->drop();
    }
}
