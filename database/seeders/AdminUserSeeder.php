<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $email = (string) env('ADMIN_EMAIL', 'bbonsportswear@gmail.com');
        $password = (string) env('ADMIN_PASSWORD', 'admin123');

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'B.BON Admin',
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ]
        );
    }
}
