<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@proprivy.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Owner User',
            'email' => 'owner@proprivy.com',
            'password' => Hash::make('password'),
            'role' => 'owner',
        ]);

        User::create([
            'name' => 'Tenant User',
            'email' => 'tenant@proprivy.com',
            'password' => Hash::make('password'),
            'role' => 'tenant',
        ]);
    }
}


