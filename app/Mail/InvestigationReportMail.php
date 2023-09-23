<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvestigationReportMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $report, $greetings;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($report, $greetings)
    {
        $this->report = $report;
        $this->greetings = $greetings;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.investigationReportMail');
    }
}
