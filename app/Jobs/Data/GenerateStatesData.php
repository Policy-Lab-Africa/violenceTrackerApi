<?php

namespace App\Jobs\Data;

use App\Models\NgState;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class GenerateStatesData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
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
        //
        $statesData = collect(json_decode(Storage::disk('s3')->get(config('inecdata.path').'index.json')));
        foreach($statesData as $state){
            NgState::updateOrCreate([
                'data_id' => $state->id,
                'name' => strtolower($state->name),
            ]);
        };
    }
}
