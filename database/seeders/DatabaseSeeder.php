<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456789'),
                'is_admin' => true
            ],
            [
                'id' => 2,
                'name' => 'Roki',
                'email' => 'roxx@gmail.com',
                'password' => Hash::make('123456789'),
                'is_admin' => false
            ]
        ]);
    }
}
