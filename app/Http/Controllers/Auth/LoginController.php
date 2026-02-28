<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AffiliateLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(AffiliateLoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
        if (! Auth::attempt(['whatsapp_phone' => $credentials['whatsapp_phone'], 'password' => $credentials['password']])) {
            return back()->withErrors(['whatsapp_phone' => 'Invalid credentials'])->withInput();
        }

        $request->session()->regenerate();
        return redirect()->intended(route('dashboard'));
    }

    public function destroy(): RedirectResponse
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }
}
