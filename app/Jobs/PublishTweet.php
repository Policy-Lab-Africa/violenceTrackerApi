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
use Stevebauman\Location\Facades\Location;
use Jaybizzle\CrawlerDetect\CrawlerDetect;

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
     * ToDo
     * Code need to be refactored in the future with more checks like adding a labels, tags etc.
     *
     * @return void
     */
    public function handle()
    {
        //...
        $tweet = substr($this->report->title ?? $this->report->description, 0, 150).'.. ';
        $link = route('violence-reports.show', ['violence_report' => $this->report->id ]);
        $CrawlerDetect = new CrawlerDetect;
        $countryName = Location::get($this->report->ip_address)->countryName;

        if($this->report->user_agent != '' || !$CrawlerDetect->isCrawler($this->report->user_agent) || $countryName == 'Nigeria' || $this->report->ip_address != null) {
            return (new TwitterService)->tweet($tweet, $this->report->file);
        } 
        
    }
}
