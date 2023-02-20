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

        $localGovernments = collect($localGovernments);
        $resultData['local_governments']['data'] = $localGovernments
        ->unique()->values();
        $resultData['local_governments']['count_unique'] = $localGovernments
        ->unique()->count();
        $resultData['local_governments']['count_reports'] = $localGovernments->groupBy('data_id')->map(function ($item, $key) {
            return [
                $item->first()->name => $item->count()
            ];
        })->values();
        
        $types = collect($types);
        $resultData['types']['data'] = $types->unique()->values();
        $resultData['types']['count_unique'] = $types->unique()->count();
        $resultData['types']['count_by_reports'] = $types->groupBy('id')->map(function ($item, $key) {
            return [
                $item->first()->name => $item->count()
            ];
        })->values();

        return [
            'data' => $data,
            'meta_data' =>$resultData,
        ];
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

        $localGovernments = collect($localGovernments);
        $resultData['local_governments']['data'] = $localGovernments
        ->unique()->values();
        $resultData['local_governments']['count_unique'] = $localGovernments
        ->unique()->count();
        $resultData['local_governments']['count_reports'] = $localGovernments->groupBy('data_id')->map(function ($item, $key) {
            return [
                $item->first()->name => $item->count()
            ];
        })->values();
        
        $types = collect($types);
        $resultData['types']['data'] = $types->unique()->values();
        $resultData['types']['count_unique'] = $types->unique()->count();
        $resultData['types']['count_by_reports'] = $types->groupBy('id')->map(function ($item, $key) {
            return [
                $item->first()->name => $item->count()
            ];
        })->values();

        return [
            'data' => $data,
            'meta_data' =>$resultData,
        ];
    }


}