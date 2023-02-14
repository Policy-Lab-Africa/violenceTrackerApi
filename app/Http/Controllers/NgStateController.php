<?php

namespace App\Http\Controllers;

use App\Models\NgState;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\NgStateService;
use App\Models\NgLocalGovernment;
use App\Http\Controllers\Controller;
use App\Http\Resources\NgLgaCollection;
use App\Http\Requests\StoreNgStateRequest;
use App\Http\Requests\UpdateNgStateRequest;
use App\Http\Resources\NgStateResourceCollection;

class NgStateController extends Controller
{
    /**
     * Return all Nigerian states
     * 
     * This endpoint returns an array of objects containing all the states identified by it's `ng_states.data_id`
     * 
     * @group INEC Location Data
     * @subgroup States
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $this->sendResponse([
            'states' => new NgStateResourceCollection(NgState::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNgStateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNgStateRequest $request)
    {
        //
    }

    /**
     * Return a specified Nigerian state
     * 
     * This endpoint returns a single state identified by it's `ng_states.data_id`
     *
     * @urlParam ngState mixed required the `data_id` or `name` of the state.
     * 
     * @group INEC Location Data
     * @subgroup States
     *
     * @param  mixed  $ngState
     * @return \Illuminate\Http\Response
     */
    public function show(string|int $ngState)
    {
        //
        try {
            
            return $this->sendResponse([
                'state' => (new NgStateService)
                            ->findState($ngState)
                            ->getState()
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * [DRAFT] Return a specified Nigerian state
     * 
     * This endpoint returns a resource `ng_states.data_id`
     *
     * .
     * 
     * @group INEC Location Data
     * 
     * @param Request $request
     * @return void
     */
    public function inecFilter(Request $request)
    {
        $request->validate([
            'state' => 'nullable|required_if:lga,*',
            'lgas' => 'nullable|in:true,false|required_if:ward,*',
        ]);

        $response = [];

        $state = null;

        if($request->has('state'))
        {
             
            $response['state'] = $state = (new NgStateService)
                            ->findState($request->state)
                            ->getState();
        }

        if($request->has('lgas'))
        {
            $response['state']  = $state?->load('lgas');
        }


        return $this->sendResponse([
            'data' => $response
        ]);

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNgStateRequest  $request
     * @param  \App\Models\NgState  $ngState
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNgStateRequest $request, NgState $ngState)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NgState  $ngState
     * @return \Illuminate\Http\Response
     */
    public function destroy(NgState $ngState)
    {
        //
    }
}
