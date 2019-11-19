<?php

namespace App\Mail;

use App\Customer;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdviceMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $customer;
    public function __construct(Customer $customer)
    {
        //
        $this->customer=$customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.advice')->with([
            'email'=> $this->customer->email,
            'full_name'=>$this->customer->full_name
        ]);
    }
}
