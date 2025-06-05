<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;

class AdminController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $admin = Admin::where('email', $credentials['email'])->first();

        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_admins' => Admin::count(),
            'server_info' => [
                'php_version' => PHP_VERSION,
                'laravel_version' => app()->version(),
                'server_time' => now()->format('Y-m-d H:i:s'),
                'environment' => app()->environment(),
            ]
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function users()
    {
        $users = User::paginate(10);
        return view('admin.users', compact('users'));
    }

    public function systemInfo()
    {
        $info = [
            'server' => $_SERVER,
            'php_info' => [
                'version' => PHP_VERSION,
                'extensions' => get_loaded_extensions(),
                'memory_limit' => ini_get('memory_limit'),
                'max_execution_time' => ini_get('max_execution_time'),
            ],
            'laravel' => [
                'version' => app()->version(),
                'environment' => app()->environment(),
                'debug' => config('app.debug'),
                'timezone' => config('app.timezone'),
            ]
        ];

        return view('admin.system-info', compact('info'));
    }
}
