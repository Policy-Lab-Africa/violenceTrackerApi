<?php

namespace App\Jobs\Data;

use App\Models\NgWard;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class GenerateWardsData implements ShouldQueue
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
        $stateDirs = Storage::directories(config('inecdata.path'));
        foreach($stateDirs as $stateDir)
        {
            $stateLga = Storage::directories($stateDir);
            foreach($stateLga as $stateLga)
            {
                $lgas = Storage::directories($stateLga);
                foreach($lgas as $lga)
                {
                    // 
                    $lgaWards = collect(json_decode(Storage::get($lga.'/wards/index.json')));

                    foreach($lgaWards as $ward)
                    {
                        NgWard::updateOrCreate([
                            'data_id' => $ward->id,
                            'name' => $ward->name,
                            'abbreviation' => $ward->abbreviation,
                            'local_government_id' => $ward->local_government_id,
                        ]);

                    }
                }

                
            }
        }
    }
}