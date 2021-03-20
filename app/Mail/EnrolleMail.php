<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnrolleMail extends Mailable
{
    use Queueable, SerializesModels;

    public $enrolle;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($enrolle)
    {
        $this->enrolle = $enrolle;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('khpk19@gmail.com', 'Хакасский политехнический колледж')
                    ->subject('Подтверждение регистрации')
                    ->view('emails.enrolle')
                    ->with($this->enrolle);
    }
}
