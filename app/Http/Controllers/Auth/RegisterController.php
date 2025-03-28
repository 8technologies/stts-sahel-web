<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationConfirmation; 
use Illuminate\Support\Facades\Log; 
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()// show the registration view
    {
        return view('auth.register'); 
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:admin_users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admin_users'],

        ]);
    }
    public function register(Request $request)//override the register function
    {
        $this->validator($request->all())->validate();

        $registrationStatus = $this->create($request->all());

        if ($registrationStatus['status'] === 'success') {
            return redirect()->route('register')->with('success', 'Registration successful! Please check your email for your password.');
        } else {
            return redirect()->route('register')->with('warning', 'Registration successful, but email could not be sent.');
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
   
    // ...
    
    protected function create(array $data)
    {
        $uppercaseLetters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowercaseLetters = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        $specialCharacters = '!@#$%^&*()_-+=[]{}|';
    
        // Generate a random password of length 8 characters
        $randomPassword = Str::random(8);
    
        // Add an uppercase letter
        $randomPassword .= $uppercaseLetters[mt_rand(0, strlen($uppercaseLetters) - 1)];
    
        // Add a lowercase letter
        $randomPassword .= $lowercaseLetters[mt_rand(0, strlen($lowercaseLetters) - 1)];
    
        // Add a number
        $randomPassword .= $numbers[mt_rand(0, strlen($numbers) - 1)];
    
        // Add a special character
        $randomPassword .= $specialCharacters[mt_rand(0, strlen($specialCharacters) - 1)];
    
        // Create the user instance without saving it yet
        $user = new User([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($randomPassword),
        ]);
    
        // Send the confirmation email with the random password
        try {
            Mail::to($user->email)->send(new RegistrationConfirmation($user->username, $user->email, $randomPassword));
    
            // If email sending is successful, save the user
            $user->save();

            return [
                'message' => 'Registration successful!',
                'status' => 'success'
            ];
        } catch (\Exception $e) {
            // Handle email sending error here
            Log::error('Email sending failed: ' . $e->getMessage(), [
                'user_email' => $user->email,
                'exception' => $e,
            ]);
            return null;
        }
    }
    
}
