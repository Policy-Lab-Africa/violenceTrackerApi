<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Models\ViolenceReport;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Services\Twitter\TwitterService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

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
        //...
        $tweet = substr($this->report->title ?? $this->report->description, 0, 150).'.. ';
        $link = 'https://app.violencetrack.ng/reports';
        (new TwitterService)->tweet(
            $tweet.$link,
            $this->report->file
        );
        return;
    }
}
