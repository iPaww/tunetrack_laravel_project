<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminControllers\BasePageController;

class UserController extends BasePageController
{
    public string $base_file_path = 'users.';

    public function index()
    {
        $users = User::paginate(10);
        return $this->view_basic_page($this->base_file_path . 'index', ['users' => $users]);
    }
    public function add()
    {
        return $this->view_basic_page($this->base_file_path . 'add');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:1,2',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image upload
        ]);

        // Handle file upload (if exists)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = null; // Handle as needed
        }

        // Create the new user
        $user = new User();
        $user->fullname = $validated['fullname'];
        $user->phone_number = $validated['phone_number'];
        $user->address = $validated['address'];
        $user->email = $validated['email'];
        $user->password = bcrypt($validated['password']);  // Hash the password
        $user->role = $validated['role'];
        $user->image = $imagePath;
        $user->save();

        // Redirect or return a response
        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    public function delete($id)
    {
        // Find the user by ID
        $user = User::find($id);

        if ($user) {
            // If user is found, delete the user
            $user->delete();

            // Return a success message and redirect back to the user list
            return redirect()->route('users.index')->with('success', 'User deleted successfully!');
        } else {
            // If user is not found, show an error message
            return redirect()->route('users.index')->with('error', 'User not found!');
        }
    }
}
