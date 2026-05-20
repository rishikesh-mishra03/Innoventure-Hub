<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials. Please try again.'])->withInput();
        }

        if (!$user->is_active) {
            return back()->withErrors(['email' => 'Your account has been deactivated.']);
        }

        Auth::login($user, $request->boolean('remember'));
        $user->update(['last_login_at' => now()]);

        return redirect()->route('dashboard')->with('success', 'Welcome back, ' . $user->name . '!');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:mongodb.users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:startup,corporate,investor,mentor',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => true,
            'is_verified' => false,
            'kyc_status' => 'pending',
            'company_verified' => false,
            'profile_complete' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Welcome to InnoVenture Hub! Complete your profile to get started.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'You have been logged out.');
    }

    public function demoLogin(Request $request)
    {
        $role = $request->get('role', 'startup');
        $demoEmails = [
            'startup' => 'demo.startup@innoventure.com',
            'corporate' => 'demo.corporate@innoventure.com',
            'investor' => 'demo.investor@innoventure.com',
            'admin' => 'demo.admin@innoventure.com',
        ];

        $email = $demoEmails[$role] ?? $demoEmails['startup'];
        $user = User::where('email', $email)->first();

        if (!$user) {
            // Create demo user
            $user = User::create([
                'name' => 'Demo ' . ucfirst($role),
                'email' => $email,
                'password' => Hash::make('demo123456'),
                'role' => $role,
                'is_active' => true,
                'is_verified' => true,
                'kyc_status' => 'verified',
                'company_verified' => true,
                'profile_complete' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Auth::login($user);
        return redirect()->route('dashboard')->with('success', 'Logged in as Demo ' . ucfirst($role) . '!');
    }
}
