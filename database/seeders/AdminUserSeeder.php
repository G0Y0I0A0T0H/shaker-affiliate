<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate([
            'whatsapp_phone' => '201000000001',
        ], [
            'name' => 'System Admin',
            'password' => 'password123',
            'role' => User::ROLE_ADMIN,
            'status' => 'active',
            'commission_rate' => 0,
            'referral_code' => null,
        ]);
    }
}
