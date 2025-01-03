<?php

namespace App\Http\Controllers;

use \DateTime;

use App\Mail\UserVerification;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\BasePageController;

class LoginController extends BasePageController
{
    private $role = [
        'admin' => 1,
        'employee' => 2,
        'user' => 3,
    ];

    public function index()
    {
        return view( 'login' );
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

        if ( !$user ) {
            $validator->errors()->add('email', 'Email not found!');
            return redirect('/login')
                ->withInput()
                ->withErrors($validator);
        } else if (!password_verify($password, $user['password'])) {
            $validator->errors()->add('password', 'Incorrect password!');
                return redirect('/login')
                    ->withInput()
                    ->withErrors($validator);
        }

        // If employee login
        if( $user->role <= 2) {
            // Password is correct, start the session
            session()->put('admin_user', [
                'id' => $user['id'],
                'fullname' => $user['fullname'],
                'email' => $user['email'],
                'role' => $user['role'], // Store user role in session
                'profile_picture' => $user['profile_picture']
            ]); // Set session variable
            return redirect('/admin');
        }

        // Password is correct, start the session
        session([
            'id' => $user->id,
            'fullname' => $user->fullname,
            'email' => $user->email,
            'role' => $user->role, // Store user role in session
            'profile_picture' => $user->image,
            'verified' => !empty($user->verified_at),
        
        ]); // Set session variable

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
            'role' => 3,
        ]);

        $verification_email = new UserVerification($inserted_record->id);
        // Uncomment this line to view email
        // return (new InvoicePaid($invoice))->render($verification_email);
        Mail::to($email)->send( $verification_email );

        if( !$inserted_record ) {
            return redirect('/register')
                ->withErrors('Something went wrong please try again later.')
                ->withInput();
        }

        return redirect('/login');
    }

    public function verification()
    {
        return $this->view_basic_page('verification_form');
    }

    public function verification_form( Request $request ): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'verification_code' => 'required|array|size:6',
            'verification_code.*' => 'required|size:1|alpha_num',
        ], [
            'verification_code.*.size' => 'Invalid format',
            'verification_code.*.required' => 'Verification code incomplete, there should be 6 characters in the code.',
            'verification_code.*.alpha_num' => 'Verification should only contain letters and numbers.',
        ]);

        // Validate email and password
        if ($validator->stopOnFirstFailure()->fails()) {
            return redirect('/verification')
                ->withErrors($validator);
        }

        // Check if the email exists in the database
        $user = User::select('verification')->where('id', session('id'))
            ->first();

        if ( $user->verification != collect($request->post('verification_code'))->join('') ) {
            return redirect('/verification')
                ->withErrors('Invalid verification code');
        }

        $user = User::where('id', session('id'))
            ->update([
                'verification' => null,
                'verified_at' => new DateTime()
            ]);
        
        session(['verified' => true]);

        return redirect('/');
    }

    public function verification_resend(): RedirectResponse|string
    {
        $verification_email = new UserVerification(session('id'));
        // Uncomment this line to view email
        // return (new UserVerification(session('id')))->render($verification_email);
        Mail::to(session('email'))->send( $verification_email );

        return redirect('/verification');
    }
}
