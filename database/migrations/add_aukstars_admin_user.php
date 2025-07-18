<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Проверяем, существует ли уже пользователь с таким email
        $existingUser = User::where('email', 'aukstars@gmail.com')->first();
        
        if (!$existingUser) {
            User::create([
                'name' => 'Aukstars Admin',
                'email' => 'aukstars@gmail.com',
                'password' => Hash::make('Rubenhair77!'),
                'email_verified_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Удаляем пользователя при откате миграции
        User::where('email', 'aukstars@gmail.com')->delete();
    }
};