<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreViolenceTypeRequest;
use App\Http\Requests\UpdateViolenceTypeRequest;
use App\Http\Resources\ViolenceTypeCollection;
use App\Models\ViolenceType;
use Illuminate\Http\Response;

class ViolenceTypeController extends Controller
{
    /**
     * Fetch violence report types
     *
     * This endpoint returns an array of objects containing all violence report types in storage.
     *
     * @group Violence Reports
     *
     * @return Response
     */
    public function index()
    {
        return $this->sendResponse([
            'types' => new ViolenceTypeCollection(ViolenceType::all()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreViolenceTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show(ViolenceType $violenceType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update(UpdateViolenceTypeRequest $request, ViolenceType $violenceType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy(ViolenceType $violenceType)
    {
        //
    }
}
