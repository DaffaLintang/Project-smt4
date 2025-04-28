<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MigrateUsersToMongoSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Mulai migrasi...');

        $users = DB::connection('mysql')->table('users')->get();

        $this->command->info('Jumlah user: ' . count($users));

        foreach ($users as $user) {
            $data = json_decode(json_encode($user), true);
            DB::connection('mongodb')->table('users')->insert($data);
        }

        $this->command->info('Migrasi selesai.');
    }
}
