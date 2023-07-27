<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationConfirmation;
use Illuminate\Support\Facades\Session;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        // Get the user and random password from the create method
        $userData = $this->create($request->all());
        $user = $userData['user'];
        $randomPassword = $userData['password'];

        event(new Registered($user));

        // Send the confirmation email with the random password
        Mail::to($user->email)->send(new RegistrationConfirmation($user->username, $user->email, $randomPassword));

        $this->guard()->login($user);

        // Set success flash message
        Session::flash('success', 'Registration successful! Please check your email for the confirmation.');

        // Redirect back to the registration page with the success flash message
        return redirect(url('/register'));
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Admin::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
