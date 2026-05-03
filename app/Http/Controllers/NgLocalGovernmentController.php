<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNgLocalGovernmentRequest;
use App\Http\Requests\UpdateNgLocalGovernmentRequest;
use App\Http\Resources\NgLgaCollection;
use App\Models\NgLocalGovernment;
use App\Models\NgState;
use App\Services\NgStateService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class NgLocalGovernmentController extends Controller
{
    /**
     * [DRAFT] Return Local Government Areas for a specified State
     * [Note] Moved to NgStateController@showLgas
     *
     * @return Response
     */
    public function index(int|string $ngState)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreNgLocalGovernmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return Response
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
     *
     * @subgroup Local Governments
     *
     * @return void
     */
    public function showLgas(string|int $ngState)
    {

        try {

            return $this->sendResponse([

                'local_government_areas' => new NgLgaCollection(
                    (new NgStateService)
                        ->findState($ngState)
                        ->getState()
                        ->lgas
                ),
            ]);
        } catch (Exception $e) {
            Log::error('FetchStateLgasFailed', [
                'Exception' => $e,
            ]);

            return $this->sendError([
                'error' => 'Something went wrong',
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update(UpdateNgLocalGovernmentRequest $request, NgLocalGovernment $ngLocalGovernment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy(NgLocalGovernment $ngLocalGovernment)
    {
        //
    }
}
