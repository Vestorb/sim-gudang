<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@simgudang.com'],
            [
                'name' => 'Administrator',
                'role' => 'admin',
                'password' => Hash::make('admin123'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'manajer@simgudang.com'],
            [
                'name' => 'Manajer Gudang',
                'role' => 'manajer',
                'password' => Hash::make('manajer123'),
            ]
        );
    }
}