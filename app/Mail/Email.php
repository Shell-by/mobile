<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    public $randomInt;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($randomInt)
    {
        $this->randomInt = $randomInt;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('wnsghks1026@naver.com')->view('email')->with('randomInt', $this->randomInt);
    }
}
