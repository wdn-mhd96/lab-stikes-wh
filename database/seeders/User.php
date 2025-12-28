<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class User extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Test Admin',
            'username' => 'testadmin',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
        \App\Models\User::create([
            'name' => 'Test User',
            'username' => 'testuser',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);
    }
}
