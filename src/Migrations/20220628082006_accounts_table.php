<?php

declare(strict_types=1);

namespace App\Migrations;

use Phoenix\Migration\AbstractMigration;

final class AccountsTable extends AbstractMigration
{
    protected function up(): void
    {
        $this->execute("CREATE TABLE `accounts` (
              `a_id` varchar(21) NOT NULL,
              `a_name` varchar(30) NOT NULL,
              `a_title` varchar(100) NOT NULL,
              `a_number` varchar(10) NOT NULL,
              `a_type` varchar(100) NOT NULL,
              `a_verification_state` varchar(100) NOT NULL,
              `a_vetted_state` varchar(100) NOT NULL,
              `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`a_id`),
              KEY `i__a_name` (`a_name`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
        );
    }

    protected function down(): void
    {
        $this->table('accounts')
            ->drop();
    }
}
