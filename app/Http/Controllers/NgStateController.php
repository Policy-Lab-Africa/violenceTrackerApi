<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNgStateRequest;
use App\Http\Requests\UpdateNgStateRequest;
use App\Models\NgState;

class NgStateController extends Controller
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
     * @param  \App\Http\Requests\StoreNgStateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNgStateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NgState  $ngState
     * @return \Illuminate\Http\Response
     */
    public function show(NgState $ngState)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NgState  $ngState
     * @return \Illuminate\Http\Response
     */
    public function edit(NgState $ngState)
    {
        //
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
