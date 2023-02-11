<?php

namespace App\Listeners;

use App\Jobs\PublishTweet as PublishTweetJob;
use App\Events\ViolenceReportCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
     * @param  \App\Events\ViolenceReportCreated  $event
     * @return void
     */
    public function handle(ViolenceReportCreated $event)
    {
        //
        PublishTweetJob::dispatch($event->report);
    }
}
