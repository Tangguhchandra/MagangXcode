<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt(value: 'admin123'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('users')->insert($admin);
    }
}