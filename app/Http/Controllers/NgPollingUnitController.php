<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNgPollingUnitRequest;
use App\Http\Requests\UpdateNgPollingUnitRequest;
use App\Http\Resources\NgPollingUnitCollection;
use App\Models\NgPollingUnit;
use App\Services\NgWardService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class NgPollingUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreNgPollingUnitRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show(NgPollingUnit $ngPollingUnit)
    {
        //
    }

    /**
     * Fetch polling units for a specified ward
     *
     * This endpoint returns an array of objects containing all the polling units for a specific ward identified by it's `ng_wards.data_id`
     *
     * @urlParam ward mixed required the `data_id` or `name` of the ward you want to fetch polling units for.
     *
     * @group INEC Location Data
     *
     * @subgroup Polling units
     *
     * @return void
     */
    public function showPollingUnits(string|int $ward)
    {
        try {

            return $this->sendResponse([
                'wards' => new NgPollingUnitCollection(
                    (new NgWardService)
                        ->findWard($ward)
                        ->getWard()
                        ->pollingUnits
                ),
            ]);
        } catch (Exception $e) {
            Log::error('FetchWardPollingUnitsFailed', [
                'Exception' => $e,
            ]);

            return $this->sendError([
                'error' => 'Something went wrong',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit(NgPollingUnit $ngPollingUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update(UpdateNgPollingUnitRequest $request, NgPollingUnit $ngPollingUnit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy(NgPollingUnit $ngPollingUnit)
    {
        //
    }
}
