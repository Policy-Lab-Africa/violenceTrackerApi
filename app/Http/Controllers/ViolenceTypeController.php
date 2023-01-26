<?php

namespace App\Http\Controllers;

use App\Models\ViolenceType;
use App\Http\Resources\ViolenceTypeCollection;
use App\Http\Requests\StoreViolenceTypeRequest;
use App\Http\Requests\UpdateViolenceTypeRequest;

class ViolenceTypeController extends Controller
{
    /**
     * Fetch violence report types
     * 
     * This endpoint returns an array of objects containing all violence report types in storage.
     * 
     * @group Violence Reports
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->sendResponse([
            new ViolenceTypeCollection(ViolenceType::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreViolenceTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreViolenceTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ViolenceType  $violenceType
     * @return \Illuminate\Http\Response
     */
    public function show(ViolenceType $violenceType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateViolenceTypeRequest  $request
     * @param  \App\Models\ViolenceType  $violenceType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateViolenceTypeRequest $request, ViolenceType $violenceType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ViolenceType  $violenceType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ViolenceType $violenceType)
    {
        //
    }
}
