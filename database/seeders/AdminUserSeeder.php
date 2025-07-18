<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $admins = [
            [
                'name' => 'Admin',
                'email' => 'admin@energy-park.com',
                'password' => 'password123'
            ],
            [
                'name' => 'Aukstars Admin',
                'email' => 'aukstars@gmail.com',
                'password' => 'password123'
            ]
        ];
        
        foreach ($admins as $admin) {
            $existingUser = User::where('email', $admin['email'])->first();
            
            if (!$existingUser) {
                User::create([
                    'name' => $admin['name'],
                    'email' => $admin['email'],
                    'password' => Hash::make($admin['password']),
                    'email_verified_at' => now(),
                ]);
            }
        }
    }
}