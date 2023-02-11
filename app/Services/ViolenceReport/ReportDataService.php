<?php

namespace App\Services\ViolenceReport;

use App\Models\NgWard;
use App\Models\NgState;
use App\Models\NgPollingUnit;
use App\Services\NgStateService;
use App\Models\NgLocalGovernment;
use Illuminate\Support\Collection;
use App\Exceptions\NgStateException;

class ReportDataService
{
    protected Collection $stateResults;
    protected Collection $localGovernmentResults;
    protected Collection $wardResults;
    protected Collection $pollingUnitsResults;
    protected array $formattedResults;

    public function __construct(
        public string $term,
        public ?string $start = null,
        public ?string $end = null,
    )
    {
        $this->start = isset($this->start) ? date('Y-m-d H:i:s', strtotime($this->start)) : null;
        $this->end = isset($this->end) ? date('Y-m-d H:i:s', strtotime($this->end)) : date('Y-m-d H:i:s', strtotime('tomorrow'));
    }
    
    /**
     * Undocumented function
     *
     * @return void
     */
    public function searchPollingUnit()
    {
        $this->pollingUnitsResults = NgPollingUnit::where('name', 'like', '%'.$this->term.'%')
                                            ->whereHas('violencereports', function($query){
                                                if(isset($this->start,$this->end))
                                                {
                                                    $query->whereBetween('created_at', [$this->start, $this->end]);
                                                }
                                                $query->without('pollingUnit');
                                            })->with('violencereports', function($query){
                                                if(isset($this->start,$this->end))
                                                {
                                                    $query->whereBetween('created_at', [$this->start, $this->end]);
                                                }
                                                $query->without('pollingUnit');
                                            })->get();

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function searchWard()
    {
        // 
        $this->wardResults = NgWard::where('name', 'like', '%'.$this->term.'%')
                                    ->whereHas('pollingUnits', function($query){
                                        $query->whereHas('violencereports', function($query){
                                            if(isset($this->start,$this->end))
                                            {
                                                $query->whereBetween('created_at', [$this->start, $this->end]);
                                            }
                                            $query->without('pollingUnit');
                                        })->with('violencereports', function($query){
                                            if(isset($this->start,$this->end))
                                            {
                                                $query->whereBetween('created_at', [$this->start, $this->end]);
                                            }
                                            $query->without('pollingUnit');
                                        });
                                    })->with('pollingUnits', function($query){
                                        $query->whereHas('violencereports', function($query){
                                            if(isset($this->start,$this->end))
                                            {
                                                $query->whereBetween('created_at', [$this->start, $this->end]);
                                            }
                                            $query->without('pollingUnit');
                                        })->with('violencereports', function($query){
                                            if(isset($this->start,$this->end))
                                            {
                                                $query->whereBetween('created_at', [$this->start, $this->end]);
                                            }
                                            $query->without('pollingUnit');
                                        });
                                    })->get();//whereHas('violencereports')->get();

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function searchLocalGovernment():self
    {
        // 
        $this->localGovernmentResults = NgLocalGovernment::where('name', 'like', '%'.$this->term.'%')
                                            ->whereHas('pollingUnits', function($query){
                                                $query->whereHas('violencereports', function($query){
                                                    if(isset($this->start,$this->end))
                                                    {
                                                        $query->whereBetween('created_at', [$this->start, $this->end]);
                                                    }
                                                    $query->without('pollingUnit');
                                                })->with('violencereports', function($query){
                                                    if(isset($this->start,$this->end))
                                                    {
                                                        $query->whereBetween('created_at', [$this->start, $this->end]);
                                                    }
                                                    $query->without('pollingUnit');
                                                });
                                            })->with('pollingUnits', function($query){
                                                $query->whereHas('violencereports', function($query){
                                                    if(isset($this->start,$this->end))
                                                    {
                                                        $query->whereBetween('created_at', [$this->start, $this->end]);
                                                    }
                                                    $query->without('pollingUnit');
                                                })->with('violencereports', function($query){
                                                    if(isset($this->start,$this->end))
                                                    {
                                                        $query->whereBetween('created_at', [$this->start, $this->end]);
                                                    }
                                                    $query->without('pollingUnit');
                                                });
                                            })->get(); //whereHas('violencereports')->get();
        

        return $this;
    }

    /**
     * Search for $term in states
     *
     * @return self
     */
    public function searchState():self
    {
        
        $this->stateResults = NgState::where('name', 'like', '%'.$this->term.'%')
                                    ->whereHas('pollingUnits', function($query){
                                        $query->whereHas('violencereports', function($query){
                                            if(isset($this->start,$this->end))
                                            {
                                                $query->whereBetween('created_at', [$this->start, $this->end]);
                                            }
                                            $query->without('pollingUnit');
                                        })->with('violencereports', function($query){
                                            if(isset($this->start,$this->end))
                                            {
                                                $query->whereBetween('created_at', [$this->start, $this->end]);
                                            }
                                            $query->without('pollingUnit');
                                        });
                                    })
                                    ->with('pollingUnits', function($query){
                                        $query->whereHas('violencereports')->with('violencereports', function($query){
                                            if(isset($this->start,$this->end))
                                            {
                                                $query->whereBetween('created_at', [$this->start, $this->end]);
                                            }
                                            $query->without('pollingUnit');
                                        });
                                    })->get();

        return $this;
    }

    public function reportDetails()
    {
        // 
        if(isset($this->stateResults))
        {
            $this->stateResults->put('meta_data', FormatData::format($this->stateResults));
        }

        if(isset($this->localGovernmentResults))
        {
            $this->localGovernmentResults->put('meta_data', FormatData::format($this->localGovernmentResults));
        }

        if(isset($this->wardResults))
        {
            $this->wardResults->put('meta_data',FormatData::format($this->wardResults));
        }

        if(isset($this->pollingUnitsResults))
        {
            $this->pollingUnitsResults->put('meta_data',FormatData::formatPoliingUnit($this->pollingUnitsResults));
        }

        return $this;
    }

    public function formatResult()
    {
        // 
        
        $this->formattedResults['state_results'][] = isset($this->stateResults) ? $this->stateResults : [];
        $this->formattedResults['local_government_results'][] = isset($this->localGovernmentResults) ? $this->localGovernmentResults : [];
        $this->formattedResults['ward_results'][] = isset($this->wardResults) ? $this->wardResults : [];
        $this->formattedResults['polling_unit_results'][] = isset($this->pollingUnitsResults) ? $this->pollingUnitsResults : [];
        return $this->formattedResults;
    }
}