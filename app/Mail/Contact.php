<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //retrieve data from session
       $sendername = session('name');
       $sendersubject = session('subject');
       $sendermsg = session('message');
       $sendermail = session('email');

        return $this->from($sendermail)
        ->subject($sendersubject)
        ->markdown('emails.contactmarkdown')
        ->with('sendername',$sendername)
        ->with('sendermsg',$sendermsg);

    }
}
