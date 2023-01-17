<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreViolenceTypeRequest;
use App\Http\Requests\UpdateViolenceTypeRequest;
use App\Models\ViolenceType;

class ViolenceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ViolenceType::all();
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ViolenceType  $violenceType
     * @return \Illuminate\Http\Response
     */
    public function edit(ViolenceType $violenceType)
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
