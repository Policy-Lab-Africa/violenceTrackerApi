<?php

namespace App\Services\ViolenceReport;

use Illuminate\Support\Collection;

class FormatData
{

    public static function format(Collection $data)
    {
        $resultData = [];
        $types = [];
        $localGovernments = [];
        $resultData['violence_reports']['count'] = 0;
        
        foreach($data as $result)
        {
            $resultData['polling_units']['count'] = count($result->pollingUnits);
            foreach($result->pollingUnits as $pollingUnit)
            {
                $resultData['violence_reports']['count'] += $pollingUnit->violencereports->count();
                array_push($localGovernments,$pollingUnit->localGovernment);
                // $localGovernments['local_governments'] = $pollingUnit->localGovernment;

                foreach($pollingUnit->violencereports->pluck('type') as $type)
                {
                    $types[] = $type;
                }

            }
        }

        $localGovernments = collect($localGovernments)->unique();
        $resultData['local_governments'] = $localGovernments;
        $resultData['local_governments']['count'] = $localGovernments->count();
        
        $types = collect($types)->unique('name');
        $resultData['types']['types'] = $types;
        $resultData['types']['count'] = $types->count();

        return $resultData;
    }

    public static function formatPoliingUnit(Collection $data)
    {
        $resultData = [];
        $types = [];
        $localGovernments = [];
        $resultData['violence_reports']['count'] = 0;
        
        $resultData['polling_units']['count'] = $data->count();
        foreach($data as $pollingUnit)
        {
            $resultData['violence_reports']['count'] += $pollingUnit->violencereports->count();
            array_push($localGovernments,$pollingUnit->localGovernment);

            foreach($pollingUnit->violencereports->pluck('type') as $type)
            {
                $types[] = $type;
            }

        }

        $localGovernments = collect($localGovernments)->unique('name');
        $resultData['local_governments'] = $localGovernments;
        $resultData['local_governments']['count'] = $localGovernments->count();
        
        $types = collect($types)->unique('name');
        $resultData['types']['types'] = $types;
        $resultData['types']['count'] = $types->count();
        
        return $resultData;
    }
}