<?php

namespace App\Http\Controllers;

use App\Models\NgState;
use App\Services\NgStateService;
use App\Models\NgLocalGovernment;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\NgLgaCollection;
use App\Http\Resources\NgWardCollection;
use App\Services\NgLocalGovernmentService;
use App\Http\Requests\StoreNgLocalGovernmentRequest;
use App\Http\Requests\UpdateNgLocalGovernmentRequest;

class NgLocalGovernmentController extends Controller
{
    /**
     * [DRAFT] Return Local Government Areas for a specified State
     * [Note] Moved to NgStateController@showLgas
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int|string $ngState)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNgLocalGovernmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNgLocalGovernmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NgLocalGovernment  $ngLocalGovernment
     * @return \Illuminate\Http\Response
     */
    public function show(NgLocalGovernment $ngLocalGovernment)
    {
        //
    }

    /**
     * Fetch local government areas for a specified state
     * 
     * This endpoint returns an array of objects containing all the local government areas for a specific state identified by it's `ng_states.data_id`
     *
     * @urlParam ngState mixed required the `data_id` or `name` of the local government you want to fetch LGAs for.
     * 
     * @group INEC Location Data
     * @subgroup Local Governments
     *
     * @param string|integer $ngState
     * @return void
     */
    public function showLgas(string|int $ngState)
    {

        try{

            return $this->sendResponse([
                
                'local_government_areas' => new NgLgaCollection(
                    (new NgStateService)
                    ->findState($ngState)
                    ->getState()
                    ->lgas
                )
            ]);
        }catch(Exception $e)
        {
            Log::error('FetchStateLgasFailed', [
                'Exception' => $e
            ]);

            return $this->sendError([
                'error' => 'Something went wrong'
            ]); 
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNgLocalGovernmentRequest  $request
     * @param  \App\Models\NgLocalGovernment  $ngLocalGovernment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNgLocalGovernmentRequest $request, NgLocalGovernment $ngLocalGovernment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NgLocalGovernment  $ngLocalGovernment
     * @return \Illuminate\Http\Response
     */
    public function destroy(NgLocalGovernment $ngLocalGovernment)
    {
        //
    }
}
