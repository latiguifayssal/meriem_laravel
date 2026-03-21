<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AuthorUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => config('scientific-platform.author_email')],
            [
                'name' => 'Test Author',
                'password' => Hash::make(config('scientific-platform.author_password')),
                'role' => UserRole::Author,
                'email_verified_at' => now(),
            ]
        );
    }
}
