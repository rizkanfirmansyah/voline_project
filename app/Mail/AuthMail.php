<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuthMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->data['type'] == 'verify') {
            return $this->subject('Account Verification')->with('data', $this->data)->view('main.mail.index');
        } else {
            return $this->subject('Account Verification')->with('data', $this->data)->view('main.mail.confirm');
        }
    }
}
