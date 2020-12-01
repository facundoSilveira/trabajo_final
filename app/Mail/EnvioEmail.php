<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnvioEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $envioEmail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($envioEmail)
    {
        $this->envioEmail = $envioEmail ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('facundosilveiradosanto@gmail.com')
                    ->view('mails.cliente') ;

        ;
    }
}
