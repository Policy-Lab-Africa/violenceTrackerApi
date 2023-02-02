<?php

namespace App\Jobs\Data;

use Illuminate\Bus\Queueable;
use App\Models\NgLocalGovernment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class GenerateLgasData implements ShouldQueue
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
        $stateDirs = Storage::disk('s3')->directories(config('inecdata.path'));
        
        foreach($stateDirs as $stateDir)
        {
            $stateLgas = Storage::disk('s3')->directories($stateDir);
            foreach($stateLgas as $stateLga)
            {
                $lgas = collect(json_decode(Storage::disk('s3')->get($stateLga.'/index.json')));
                foreach($lgas as $lga)
                {
                    // 
                    NgLocalGovernment::updateOrCreate([
                        'data_id' => $lga->id,
                        'name' => $lga->name,
                        'abbreviation' => $lga->abbreviation,
                        'state_id' => $this->findCorrectStateId($lga->state_name),
                    ]);
                }

                
            }
        }

    }

    private function findCorrectStateId($name)
    {
        $statesData = collect(json_decode(Storage::disk('s3')->get(config('inecdata.path').'index.json')));

        return $state = $statesData->where('name', $name)->first()->id;
    }
}
