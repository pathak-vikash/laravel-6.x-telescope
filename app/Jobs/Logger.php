<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Foundation\Inspiring;

class Logger implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(\App\User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // add logs here
        sleep(2);
        $message = $this->user->name . ": " .Inspiring::quote();
        \Log::emergency("Emergency: ". $message);
        \Log::alert("Alert: ". $message);
        \Log::critical("Critical: ". $message);
        \Log::error("Error: ". $message);
        \Log::Warning("Warning: ". $message);
        \Log::notice("Notice: ". $message);
        \Log::info("Info: ". $message);
        \Log::debug("Debug: ". $message);
    }
}
