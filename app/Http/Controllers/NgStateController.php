<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNgStateRequest;
use App\Http\Requests\UpdateNgStateRequest;
use App\Http\Resources\NgStateResourceCollection;
use App\Models\NgState;
use App\Services\NgStateService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NgStateController extends Controller
{
    /**
     * Return all Nigerian states
     *
     * This endpoint returns an array of objects containing all the states identified by it's `ng_states.data_id`
     *
     * @group INEC Location Data
     *
     * @subgroup States
     *
     * @return Response
     */
    public function index()
    {
        //
        return $this->sendResponse([
            'states' => new NgStateResourceCollection(NgState::all()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
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
     *
     * @subgroup States
     *
     * @param  mixed  $ngState
     * @return Response
     */
    public function show(string|int $ngState)
    {
        //
        try {

            return $this->sendResponse([
                'state' => (new NgStateService)
                    ->findState($ngState)
                    ->getState(),
            ]);
        } catch (\Throwable $th) {
            // throw $th;
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

        if ($request->has('state')) {

            $response['state'] = $state = (new NgStateService)
                ->findState($request->state)
                ->getState();
        }

        if ($request->has('lgas')) {
            $response['state'] = $state?->load('lgas');
        }

        return $this->sendResponse([
            'data' => $response,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update(UpdateNgStateRequest $request, NgState $ngState)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy(NgState $ngState)
    {
        //
    }
}
