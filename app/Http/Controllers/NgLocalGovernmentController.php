<?php

namespace App\Http\Controllers;

use App\Models\NgState;
use App\Models\NgLocalGovernment;
use App\Http\Resources\NgLgaCollection;
use App\Http\Requests\StoreNgLocalGovernmentRequest;
use App\Http\Requests\UpdateNgLocalGovernmentRequest;

class NgLocalGovernmentController extends Controller
{
    /**
     * Return Local Government Areas for a specified State
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int|string $ngState)
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NgLocalGovernment  $ngLocalGovernment
     * @return \Illuminate\Http\Response
     */
    public function edit(NgLocalGovernment $ngLocalGovernment)
    {
        //
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
