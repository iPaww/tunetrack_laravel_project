<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

use App\Models\User;

class UserForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($user_id)
    {
        $verification_code = Str::random(6);
        User::where('id', $user_id)
            ->update([ 'verification' => $verification_code ]);
        $user = User::where('id', $user_id)
            ->first();
        $this->user = $user;
        $this->authentication = Crypt::encryptString($verification_code);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Forgot Password',
            from: new Address('no-reply@tunetrack.online', 'Tunetrack'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.password-reset',
            with: [
                'user' => $this->user,
                'authentication_code' => $this->authentication,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
