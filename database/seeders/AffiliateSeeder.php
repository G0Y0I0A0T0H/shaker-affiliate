<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\ReferralCodeService;
use Illuminate\Database\Seeder;

class AffiliateSeeder extends Seeder
{
    public function run(): void
    {
        $service = app(ReferralCodeService::class);

        User::query()->updateOrCreate([
            'whatsapp_phone' => '201000000777',
        ], [
            'name' => 'Demo Affiliate',
            'password' => 'password123',
            'role' => User::ROLE_AFFILIATE,
            'status' => 'active',
            'commission_rate' => 8,
            'referral_code' => $service->generateUnique(),
        ]);
    }
}
