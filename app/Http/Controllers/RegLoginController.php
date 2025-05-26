<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RegLoginController extends Controller
{
    // Show login form
    public function showLoginForm() {
        return view('manage_reg_login.login');
    }

    // Login logic
    public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $user = User::where('username', $request->username)
            ->where('role', $request->role)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('home');
        }

        return back()->withErrors(['login_error' => 'Invalid credentials']);
    }

    // Show register form
    public function showRegisterForm() {
        return view('manage_reg_login.register');
    }

    // Register logic
    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'dob' => 'nullable|date',
            'password' => 'required|min:6|confirmed',
            'role' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'photo' => 'uploads/default.jpg'
        ]);

        return redirect()->route('manage_reg_login.login')->with('register_success', 'Registration successful! Please login.');
    }

    // Profile view
    public function profile() {
        return view('manage_reg_login.profile');
    }

    // Edit profile form
    public function editProfile()
    {
        $user = Auth::user();
        return view('manage_reg_login.editProfile', compact('user'));
    }

    // Update profile logic
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
            'dob' => 'nullable|date',
            'address' => 'nullable|string|max:255',        
        ]);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'address' => $request->address,
        ]);
        
        return redirect()->route('manage_reg_login.profile')->with('success', 'Profile updated successfully.');
    }


    public function updatePhoto(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profile_photos', 'public');

            $user->photo = $path;
            $user->save();

            return redirect()->back()->with('success', 'Profile photo updated.');
        }

        return redirect()->back()->with('error', 'No file uploaded.');
    }

    public function removePhoto(Request $request)
    {
        $user = Auth::user();

        // Delete the current photo if exists
        if ($user->photo && \Storage::disk('public')->exists($user->photo)) {
            \Storage::disk('public')->delete($user->photo);
        }

        // Reset photo column to null
        $user->photo = null;
        $user->save();

        return redirect()->back()->with('success', 'Profile photo removed successfully.');
    }

    // Show password form
    public function showChangePassword() {
        return view('manage_reg_login.changePassword');
    }

    // Change password logic
    public function updatePassword(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['error' => 'Current password is incorrect']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('manage_reg_login.changePassword')->with('success', 'Password updated successfully.');
    }


    public function checkUsername(Request $request)
    {
        $exists = User::where('username', $request->username)->exists();
        return response()->json(['available' => !$exists]);
    }    
    
    public function logout(Request $request)
    {
        Auth::logout(); // Logs out the user

        $request->session()->invalidate(); // Invalidate session
        $request->session()->regenerateToken(); // Prevent CSRF reuse

        return redirect()->route('manage_reg_login.login')->with('success', 'You have been logged out successfully.');
    }    
}

