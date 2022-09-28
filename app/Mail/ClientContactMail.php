<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $clientData = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $clientData)
    {
        $this->clientData = $clientData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.clientContact');
    }
}
