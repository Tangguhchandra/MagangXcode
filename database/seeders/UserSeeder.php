<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Bambang',
                'email' => 'bambang@gmail.com',
                'password' => bcrypt(value: 'bambang123'),
                'role' => 'pemagang',
                'created_at' => now(),
                'updated_at' => now(),
                
            ],
            [
                'name' => 'Siti',
                'email' => 'siti@gmail.com',
                'password' => bcrypt(value: 'siti123'),
                'role' => 'pemagang',
                'created_at' => now(),
                'updated_at' => now(),

            ]
        ];

        DB::table('users')->insert(values: $users);
    }
}