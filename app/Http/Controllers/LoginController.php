<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\BasePageController;

class LoginController extends BasePageController
{
    private string $superAdmin = "SuperAdmin@gmail.com";
    private string $superPassord = "Tunetrack_superAdmin";
    private $role = [
        'admin' => 1,
        'user' => 2,
    ];

    public function index()
    {
        return $this->view_basic_page( 'login' );
    }

    public function login( Request $request ): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
    
        // Validate email and password
        if ($validator->fails()) {
            return redirect('/login')
                ->withErrors($validator)
                ->withInput();
        }

        $email = $request->post('email');
        $password = $request->post('password');

        // Check if the email exists in the database
        $user = User::where('email', $email)
            ->first();

        if ( $user ) {

            if (password_verify($password, $user['password'])) {
                // Password is correct, start the session
                session([
                    'id' => $user['id'],
                    'fullname' => $user['fullname'],
                    'email' => $user['email'],
                    'role' => $user['role'] // Store user role in session
                
                ]); // Set session variable

                // Redirect based on user role
                if ( $this->role[$user['role']] <= 1 ) {
                    return redirect('/admin'); // Redirect to admin dashboard
                }
            } else {
                echo '<script> alert("Incorrect password!"); </script>';
                $validator->errors()->add('password', 'Incorrect password!');
                return redirect('/login')
                    ->withInput()
                    ->withErrors($validator);
            }
        } else {
            $validator->errors()->add('email', 'Email not found!');
            return redirect('/login')
                ->withInput()
                ->withErrors($validator);
        }

        return redirect('/');
    }

    public function logout(Request $request): RedirectResponse
    {
        session()->forget(['id', 'fullname', 'email', 'role', ]);
        
        // Prevent caching of the page to avoid "back" button issues
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");
        
        return redirect('/login');
    }

    public function register()
    {
        return $this->view_basic_page( 'register' );
    }

    public function register_form( Request $request ): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'email' => 'required',
            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            'confirm_password' => 'required'
        ]);

        // Validate email and password
        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }

        $fullname = $request->post('fullname');
        $phone_number = $request->post('phone_number');
        $address = $request->post('address');
        $email = $request->post('email');
        $password = $request->post('password');
        $confirm_password = $request->post('confirm_password');

        # Check if password and confirm password match
        if ($password !== $confirm_password) {
            $validator->errors()->add('confirm_password', "Password and confirm password do not match");
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }

        // $email_check_sql = "SELECT * FROM users WHERE email = '$email'";
        // $email_check_result = $conn->query($email_check_sql);

        # Check if email exists in the database
        $email_check = User::where('email', $email)
            ->first();

        if ( $email_check ) {
            $validator->errors()->add('email', "Email already exists!");
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }
        
        # Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        # Insert data into the database
        $inserted_record = User::create([
            'fullname' => $fullname,
            'phone_number' => $phone_number,
            'address' => $address,
            'email' => $email,
            'password' => $hashed_password,
        ]);

        if( !$inserted_record ) {
            return redirect('/register')
                ->withErrors('Something went wrong please try again later.')
                ->withInput();
        }

        return redirect('/login');
    }
}