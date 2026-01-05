<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Events\CustomerStatusUpdated;
use Illuminate\Support\Facades\Log;
class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
    public function showRegister()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'customer';
        $data['is_online'] = true;
        $user = User::create($data);
        Auth::login($user);
        $request->session()->regenerate();
        Log::info('User registered & online', ['user_id' => $user->id]);
        event(new CustomerStatusUpdated($user));
        return redirect()->route('dashboard')
            ->with('success', 'Account created successfully!');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = auth()->user();
            $user->update(['is_online' => true]);

            Log::info('User logged in & online', [
                'user_id' => $user->id,
            ]);

            event(new CustomerStatusUpdated($user));

            return redirect()->route('dashboard')
                ->with('success', 'Welcome back!');
        }

        return back()->with('error', 'Invalid login credentials');
    }

    public function logout(Request $request)
    {
        $user = auth()->user();

        if ($user) {
            $user->update(['is_online' => false]);

            Log::info('User logged out & offline', [
                'user_id' => $user->id,
            ]);

            event(new CustomerStatusUpdated($user));
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')
            ->with('success', 'Logged out successfully');
    }
}
