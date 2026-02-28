<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAffiliateRequest;
use App\Models\User;
use App\Services\ReferralCodeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AffiliateController extends Controller
{
    public function index(): View
    {
        $affiliates = User::query()->where('role', User::ROLE_AFFILIATE)->latest()->paginate(20);
        return view('admin.affiliates.index', compact('affiliates'));
    }

    public function store(StoreAffiliateRequest $request, ReferralCodeService $referralCodeService): RedirectResponse
    {
        User::query()->create([
            ...$request->validated(),
            'role' => User::ROLE_AFFILIATE,
            'status' => 'active',
            'referral_code' => $referralCodeService->generateUnique(),
        ]);

        return back()->with('success', 'Affiliate created.');
    }

    public function suspend(User $affiliate): RedirectResponse
    {
        $affiliate->update(['status' => 'suspended']);
        return back()->with('success', 'Affiliate suspended.');
    }

    public function destroy(User $affiliate): RedirectResponse
    {
        $affiliate->delete();
        return back()->with('success', 'Affiliate soft-deleted.');
    }
}
