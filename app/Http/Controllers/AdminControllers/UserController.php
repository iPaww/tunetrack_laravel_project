<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AdminControllers\BasePageController;

class UserController extends BasePageController
{
    public string $base_file_path = 'users.';

    public function index()
    {
        $users = User::get();

        return $this->view_basic_page( $this->base_file_path . 'index', [
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $user = new User();
        $user->fullname = $request->fullname;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Encrypt the password

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imagePath = $image->store('users', 'public');
            $user->profile_picture = $imagePath;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User added successfully!');
    }

    public function delete($id)
    {
        // Find the user by ID and delete it
        $user = User::findOrFail($id);
        $user->delete();

        // Redirect to users list with a success message
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
