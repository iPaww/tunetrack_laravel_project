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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:6',
        ]);

        // Fetch the admin user
        $user = User::find(session('admin_user.id'));

        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'Admin user not found!']);
        }

        // Update user details
        $user->fullname = $validated['fullname'];
        $user->email = $validated['email'];
        $user->phone_number = $validated['phone_number'];
        $user->address = $validated['address'];

        // Handle profile image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($user->image && file_exists(storage_path('app/public/adminprofile/' . $user->id . '/' . $user->image))) {
                unlink(storage_path('app/public/adminprofile/' . $user->id . '/' . $user->image));
            }

            // Store new image
            $imageName = time() . '.' . $request->image->extension();
            $image = $request->file('image');
            $imagePath = $image->storeAs("adminprofile/$user->id",$imageName, 'public');
            $user->image = 'storage/' . $imagePath;
            session([ 'admin_user.profile_picture' => 'storage/' . $imagePath ]);
        }

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Save changes to the database
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
    }
}
