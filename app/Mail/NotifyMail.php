<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = $this->details['name'];
        $email = $this->details['email'];
        $body = $this->details['body'];

        return $this->subject($this->details['subject'])
            ->from($this->details['email'], config('app.nombre_principal'))
            ->view('emails.myTestMail', compact('name', 'email', 'body'));
    }
}
