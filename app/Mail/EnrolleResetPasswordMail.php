<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnrolleResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

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
                    ->subject('Восстановление доступа')
                    ->view('emails.enrolle_reset_password')
                    ->with($this->enrolle);
    }
}
