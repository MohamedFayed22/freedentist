<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $data2;
    public function __construct($data2)
    {
        $this->data2 = $data2;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@freedentist.net')->subject('تغيير كلمة المرور')
                ->view('emails.forgetPassword')->with(['data'=> $this->data2]);
    }
}
