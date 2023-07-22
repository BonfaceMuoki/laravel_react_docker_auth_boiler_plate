<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendAccesorInviteMail extends Mailable
{
    use Queueable, SerializesModels;


    public $token, $registration_url, $login_url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $registration_url, $login_url)
    {
        $this->token = $token;
        $this->registration_url = $registration_url;
        $this->login_url = $login_url;
        //
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Valuation Firm Invite',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'Email.accesor.inviteAccesor',
            with: [
                'token' => $this->token,
                'rgistrationcallbackurl' => $this->registration_url,
                'logincallback' => $this->login_url,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}