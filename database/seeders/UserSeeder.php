<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@stockly.id'],
            ['name' => 'Budi Santoso', 'password' => Hash::make('password123'), 'role' => 'admin']
        );

        User::updateOrCreate(
            ['email' => 'kasir@stockly.id'],
            ['name' => 'Rina Amelia', 'password' => Hash::make('password123'), 'role' => 'kasir']
        );
    }
}