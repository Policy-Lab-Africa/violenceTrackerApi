<?php

namespace App\Jobs;

use App\Models\ViolenceReport;
use App\Services\Twitter\TwitterService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PublishTweet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public ViolenceReport $report)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // ...
        $tweet = substr($this->report->title ?? $this->report->description, 0, 150).'.. ';
        $link = 'https://app.violencetrack.ng/reports';
        (new TwitterService)->tweet(
            $tweet.$link,
            $this->report->file
        );

    }
}
