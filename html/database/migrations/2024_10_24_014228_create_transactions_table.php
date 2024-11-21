<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        // Use DB::unprepared() to create the table
        DB::unprepared('
            CREATE TABLE transactions (
                id BIGINT NOT NULL AUTO_INCREMENT,
                customer_id TINYINT NOT NULL,
                transaction_type TINYINT NOT NULL,
                amount DECIMAL(8, 2) NOT NULL,
                transaction_status TINYINT NOT NULL,
                transaction_date DATETIME NOT NULL,
                description TEXT NOT NULL,
                created_at TIMESTAMP NULL DEFAULT NULL,
                updated_at TIMESTAMP NULL DEFAULT NULL,
                PRIMARY KEY (id, transaction_date),  -- Include transaction_date in the primary key for partitioning
                INDEX (customer_id, transaction_date)
            ) ENGINE=InnoDB
            PARTITION BY RANGE (YEAR(transaction_date)) (
                PARTITION p2021 VALUES LESS THAN (2022),
                PARTITION p2022 VALUES LESS THAN (2023),
                PARTITION p2023 VALUES LESS THAN (2024),
                PARTITION p2024 VALUES LESS THAN (2025)
            );
        ');
    }

    public function down()
    {
        DB::unprepared('DROP TABLE IF EXISTS transactions');
    }
}
