<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactServiceNotification extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $contact;

    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    public function build()
    {
        return $this->subject('New Contact Service Request')
                    ->view('emails.contact-service-notification');
    }
}
