<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Проверяем, существует ли уже пользователь
        $existingUser = User::where('email', 'admin@energy-park.com')->first();
        
        if (!$existingUser) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@energy-park.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]);
        }
    }
}