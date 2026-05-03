<?php

namespace App\Listeners;

use App\Events\ViolenceReportCreated;
use App\Jobs\PublishTweet as PublishTweetJob;

class PublishTweet
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(ViolenceReportCreated $event)
    {
        //
        PublishTweetJob::dispatch($event->report);
    }
}
