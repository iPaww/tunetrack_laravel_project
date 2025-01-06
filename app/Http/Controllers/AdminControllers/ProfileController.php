<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AdminControllers\BasePageController;

class ProfileController extends BasePageController
{
    public string $base_file_path = 'profile.';

    public function index()
    {
        $user = User::find(session('admin_user.id'));

        return $this->view_basic_page($this->base_file_path . 'index', [
            'user' => $user
        ]);
    }

    public function update(Request $request)
{
    // Validate input
    $validated = $request->validate([
        'fullname' => 'required|string|max:255',
        'email' => 'required|email',
        'phone_number' => 'required|string|max:20',
        'address' => 'required|string',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'password' => 'nullable|string|min:6', // Optional password
    ]);

    // Fetch the admin user
    $user = User::find(session('admin_user.id')); // Ensure session contains the admin ID

    if (!$user) {
        return redirect()->back()->withErrors(['error' => 'Admin user not found!']);
    }

    // Update the user fields
    $user->fullname = $validated['fullname'];
    $user->email = $validated['email'];
    $user->phone_number = $validated['phone_number'];
    $user->address = $validated['address'];

    // Handle profile picture upload
    if ($request->hasFile('profile_picture')) {
        $imageName = time() . '.' . $request->profile_picture->extension();
        $request->profile_picture->move(public_path('assets/images/users/' . $user->id), $imageName);
        $user->profile_picture = $imageName;
    }

    // Update password if provided
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    // Save changes to the database
    $user->save();

    return redirect()->route('index')->with('success', 'Profile updated successfully!');
}
}
