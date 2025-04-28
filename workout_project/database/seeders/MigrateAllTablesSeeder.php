<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MigrateAllTablesSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Mulai migrasi semua tabel...');

        // Ambil semua nama tabel dari MySQL
        $tables = DB::connection('mysql')->select('SHOW TABLES');
        $keyName = 'Tables_in_' . env('MYSQL_DB_DATABASE', 'workout_db');

        foreach ($tables as $table) {
            $tableName = $table->$keyName;
            $this->command->info("Migrasi tabel: $tableName");

            $rows = DB::connection('mysql')->table($tableName)->get();

            $this->command->info('Jumlah data: ' . count($rows));

            foreach ($rows as $row) {
                $data = json_decode(json_encode($row), true);
                DB::connection('mongodb')->table($tableName)->insert($data);
            }

            $this->command->info("Migrasi tabel $tableName selesai.\n");
        }

        $this->command->info('Migrasi semua tabel selesai!');
    }
}
