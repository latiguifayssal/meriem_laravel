<?php

namespace Database\Seeders;

use App\Enums\FieldOfStudy;
use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => config('scientific-platform.admin_email')],
            [
                'name' => 'Administrator',
                'password' => Hash::make(config('scientific-platform.admin_password')),
                'role' => UserRole::Admin,
                'field_of_study' => FieldOfStudy::ComputerScienceAi,
                'email_verified_at' => now(),
            ]
        );
    }
}
