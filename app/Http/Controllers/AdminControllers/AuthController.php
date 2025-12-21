<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm(Request $request)
    {
        // Redirect authenticated users away from login page - use 303 See Other for better cache control
        if (Auth::check()) {
            return redirect()->route('admin.dashboard')
                ->withHeaders([
                    'Cache-Control' => 'no-cache, no-store, must-revalidate, max-age=0',
                    'Pragma' => 'no-cache',
                    'Expires' => '0',
                    'Vary' => '*',
                ]);
        }

        // Prevent caching of login page with all possible headers
        $response = response()->view('adminpages.auth.login');
        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0, private');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');
        $response->headers->set('Last-Modified', gmdate('D, d M Y H:i:s') . ' GMT');
        $response->headers->set('Vary', '*');
        
        return $response;
    }

    /**
     * Handle a login request.
     */
    public function login(Request $request)
    {
        // Redirect authenticated users away from login page
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Check if user exists and is blocked
        $user = \App\Models\User::where('email', $credentials['email'])->first();
        if ($user && $user->blocked) {
            return back()->withErrors([
                'email' => 'Your account has been blocked. Please contact administrator.',
            ])->onlyInput('email');
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Double check after authentication
            if (Auth::user()->blocked) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Your account has been blocked. Please contact administrator.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();
            
            // Store user role in session
            Session::put('auth_user_role', Auth::user()->role);
            
            // Clear any cache and redirect with 303 See Other for better cache control
            return redirect()->route('admin.dashboard')
                ->setStatusCode(303)
                ->withHeaders([
                    'Cache-Control' => 'no-cache, no-store, must-revalidate, max-age=0',
                    'Pragma' => 'no-cache',
                    'Expires' => '0',
                    'Vary' => '*',
                ]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle a logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Clear session role
        Session::forget('auth_user_role');

        // Redirect to login with cache control headers to prevent caching
        return redirect()->route('admin.login')
            ->withHeaders([
                'Cache-Control' => 'no-cache, no-store, must-revalidate, max-age=0',
                'Pragma' => 'no-cache',
                'Expires' => '0',
            ]);
    }
}
