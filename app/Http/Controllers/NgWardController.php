<?php

namespace App\Http\Controllers;

use App\Models\NgWard;
use App\Services\NgWardService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\NgWardCollection;
use App\Http\Requests\StoreNgWardRequest;
use App\Http\Requests\UpdateNgWardRequest;
use App\Services\NgLocalGovernmentService;
use App\Http\Resources\NgPollingUnitCollection;

class NgWardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNgWardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNgWardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NgWard  $ngWard
     * @return \Illuminate\Http\Response
     */
    public function show(NgWard $ngWard)
    {
        //
    }

    /**
     * Fetch wards for a specified local government area
     * 
     * This endpoint returns an array of objects containing all the wards for a specific local government identified by it's `ng_local_government_areas.data_id`
     *
     * @urlParam lga mixed required the `data_id` or `name` of the local government you want to fetch wards for.
     * 
     * @group INEC Location Data
     * @subgroup Wards
     * 
     * @param string|integer $lga
     * @return void
     */
    public function showWards(string|int $lga)
    {
        try{

            return $this->sendResponse([                
              'wards' =>  new NgWardCollection(
                    (new NgLocalGovernmentService)
                    ->findLg($lga)
                    ->getLg()
                    ->wards
                )
            ]);
        }catch(Exception $e)
        {
            Log::error('FetchLgaWardsFailed', [
                'Exception' => $e
            ]);

            return $this->sendError([
                'error' => 'Something went wrong'
            ]); 
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NgWard  $ngWard
     * @return \Illuminate\Http\Response
     */
    public function edit(NgWard $ngWard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNgWardRequest  $request
     * @param  \App\Models\NgWard  $ngWard
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNgWardRequest $request, NgWard $ngWard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NgWard  $ngWard
     * @return \Illuminate\Http\Response
     */
    public function destroy(NgWard $ngWard)
    {
        //
    }
}
