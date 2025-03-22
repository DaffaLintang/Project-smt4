<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name'=> 'Admin User',
            'email'=> 'admin@mail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin'
        ]);

        $user = User::create([
            'name'=> 'User',
            'email'=> 'user@mail.com',
            'password' => Hash::make('123456'),
            'role' => 'user'

        ]);
    }
}
