<?php

namespace App\Jobs\Data;

use App\Models\NgPuLocation;
use App\Models\NgPollingUnit;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class GeneratePuData implements ShouldQueue
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
                    if(Storage::disk('s3')->exists($lga.'/wards'))
                    {
                        $lgaWards = Storage::disk('s3')->directories($lga.'/wards');
                    } else {

                        $subDirs = Storage::disk('s3')->allDirectories($lga);
                        foreach ($subDirs as $subDir) {
                            if(Storage::disk('s3')->exists($subDir.'/wards'))
                            {
                                $lgaWards = Storage::disk('s3')->directories($subDir.'/wards');
                                continue;
                            }
                        }
                    }
                    
                    foreach($lgaWards as $ward)
                    {
                        if(Storage::disk('s3')->exists($ward.'/units/index.json'))
                        {
                            $units = Storage::disk('s3')->get($ward.'/units/index.json');
                        } else {
                            // Lagos has some data in subfolders, this handles that
                            $subFolder = Storage::disk('s3')->directories($ward);
                            $units = Storage::disk('s3')->get($subFolder[0].'/units/index.json');
                        }
                        
                        $units = collect(json_decode($units));
                        foreach ($units as $unit) {
                            // dd($unit->location->latitude);
                            # code...
                            NgPollingUnit::updateOrCreate([
                                'data_id' => $unit->id,
                                'name' => $unit->name,
                                'registration_area_id' => $unit->registration_area_id,
                                'precise_location' => $unit->precise_location,
                                'abbreviation' => $unit->abbreviation,
                                'units' => $unit->units,
                                'delimitation' => $unit->delimitation,
                                'remark' => $unit->remark,
                                'ward_id' => $unit->ward_id,
                            ]);
                            
                            NgPuLocation::updateOrCreate([
                                'ng_polling_unit_id' => $unit->id,
                                'latitude' => $unit->location?->latitude,
                                'longitude' => $unit->location?->longitude,
                                'viewport' => json_encode($unit->location?->viewport),
                                'formatted_address' => $unit->location?->formatted_address,
                                'google_map_url' => $unit->location?->google_map_url,
                                'google_place_id' => $unit->location?->google_place_id,
                            ]);
                            
                        }

                    }
                }

                
            }
        }
    }
}
