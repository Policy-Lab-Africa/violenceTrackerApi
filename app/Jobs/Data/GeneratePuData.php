<?php

namespace App\Jobs\Data;

use App\Models\NgPuLocation;
use App\Models\NgPollingUnit;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class GeneratePuData 
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 3600;

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
        try{

            $stateDirs = Storage::disk('s3')->directories(config('inecdata.path'));
            foreach($stateDirs as $stateDir)
            {
                $stateLga = Storage::disk('s3')->directories($stateDir);
                foreach($stateLga as $stateLga)
                {
                    Log::debug('RANCreatePU', [
                        'unit' => $stateLga
                    ]);
                    $lgas = Storage::disk('s3')->directories($stateLga);
                    foreach($lgas as $lga)
                    {
                        Log::debug('RAN2CreatePU', [
                            'unit' => $lga
                        ]);
                        $allFiles = Storage::disk('s3')->allFiles($lga);
                        //               
                        foreach($allFiles as $file)
                        {
                            Log::debug('RAN3CreatePU', [
                                'unit' => $file
                            ]);
                            if (strpos($file, '/units/index.json') !== false) {

                                $units = collect(json_decode(Storage::disk('s3')->get($file)));
                                foreach ($units as $unit) {
                                    # code...
                                        
                                    NgPollingUnit::firstOrCreate([
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
                                    
                                    NgPuLocation::firstOrCreate([
                                        'ng_polling_unit_id' => $unit->id,
                                        'latitude' => $unit->location?->latitude,
                                        'longitude' => $unit->location?->longitude,
                                        'viewport' => json_encode($unit->location?->viewport),
                                        'formatted_address' => $unit->location?->formatted_address,
                                        'google_map_url' => $unit->location?->google_map_url,
                                        'google_place_id' => $unit->location?->google_place_id,
                                    ]);

                                    Log::debug('CreatePU', [
                                        'unit' => $unit->name,
                                    ]);
                                }
    
                            }
                            
                        }
                    }
                }
            }
        } catch(Throwable $th)
        {
            Log::error($th);
        }
    }
}
