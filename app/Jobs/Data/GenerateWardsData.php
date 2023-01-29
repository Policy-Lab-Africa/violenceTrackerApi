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
        $stateDirs = Storage::disk('s3')->directories(config('inecdata.path'));
        foreach($stateDirs as $stateDir)
        {
            $stateLga = Storage::disk('s3')->directories($stateDir);
            foreach($stateLga as $stateLga)
            {
                $lgas = Storage::disk('s3')->directories($stateLga);
                foreach($lgas as $lga)
                {
                    // 
                    if (Storage::disk('s3')->exists($lga.'/wards/index.json')) {
                        
                        $lgaWards = collect(json_decode(Storage::disk('s3')->get($lga.'/wards/index.json')));
                    } else {
                        $subDirs = Storage::disk('s3')->allDirectories($lga);
                        foreach($subDirs as $subDir)
                        {
                            if(Storage::disk('s3')->exists($subDir.'/wards/index.json'))
                            {
                                $lgaWards = collect(json_decode(Storage::disk('s3')->get($subDir.'/wards/index.json')));
                            }
                        }
                    }

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
