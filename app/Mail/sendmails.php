<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class sendmails extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $password;
    public $rolename;
    /**
     * Create a new message instance.
     */
    public function __construct($email,$password,$rolename)
    {
        //
        $this->email = $email;
        $this->password = $password;
        $this->rolename = $rolename;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'WelcomeUser',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin.adminmailmessage',
            with: ['email'=>$this->email,'password'=>$this->password,'rolename'=>$this->rolename],

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
