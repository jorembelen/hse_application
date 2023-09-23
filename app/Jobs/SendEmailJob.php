<?php

namespace App\Jobs;

use App\Mail\IncidentReportMail;
use App\Services\GreetingService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $details = $this->details;
        $greetings = GreetingService::getGreeting();

        // $projectEmail = 'jorembelen@gmail.com';
        // return $details;
        Mail::to($details[1])->send(new IncidentReportMail($details[0], $greetings));
    }
}
