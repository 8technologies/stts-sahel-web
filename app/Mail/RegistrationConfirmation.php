<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationConfirmation extends Mailable
{
    use SerializesModels;

    public $username;
    public $email;
    public $password;

    public function __construct($username, $email, $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Welcome to the National Seed Tracing and Tracking System! ')
            ->view('emails.registration_confirmation');
    }
}
