<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNgWardRequest;
use App\Http\Requests\UpdateNgWardRequest;
use App\Models\NgWard;

class NgWardController extends Controller
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
     * @param  \App\Http\Requests\StoreNgWardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNgWardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NgWard  $ngWard
     * @return \Illuminate\Http\Response
     */
    public function show(NgWard $ngWard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NgWard  $ngWard
     * @return \Illuminate\Http\Response
     */
    public function edit(NgWard $ngWard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNgWardRequest  $request
     * @param  \App\Models\NgWard  $ngWard
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNgWardRequest $request, NgWard $ngWard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NgWard  $ngWard
     * @return \Illuminate\Http\Response
     */
    public function destroy(NgWard $ngWard)
    {
        //
    }
}
