<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


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

    use RegistersUsers;

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

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
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

        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($randomPassword),
        ]);
    }
}
