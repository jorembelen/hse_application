<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IncidentReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $incident, $greetings;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($incident, $greetings)
    {
        $this->incident = $incident;
        $this->greetings = $greetings;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.incidentReportEmail');
    }
}
