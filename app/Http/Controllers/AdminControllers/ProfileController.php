<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the profile page.
     */
    public function index()
    {
        $user = Auth::user();
        return view('adminpages.profile.index', compact('user'));
    }

    /**
     * Update profile information.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        $imagePath = $user->image;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            $imagePath = $request->file('image')->store('users', 'public');
        }

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.profile.index')
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * Change password.
     */
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Check current password
        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors([
                'current_password' => 'The current password is incorrect.',
            ]);
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.profile.index')
            ->with('success', 'Password changed successfully.');
    }
}
