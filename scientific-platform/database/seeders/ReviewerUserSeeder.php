<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ReviewerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => config('scientific-platform.reviewer_email')],
            [
                'name' => 'Test Reviewer',
                'password' => Hash::make(config('scientific-platform.reviewer_password')),
                'role' => UserRole::Reviewer,
                'email_verified_at' => now(),
            ]
        );
    }
}
