<?php

namespace App\Http\Controllers;

use App\Models\NgState;
use App\Http\Requests\StoreNgStateRequest;
use App\Http\Requests\UpdateNgStateRequest;
use App\Http\Resources\NgStateResourceCollection;

class NgStateController extends Controller
{
    /**
     * Return all Nigerian states.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $this->sendResponse([
            new NgStateResourceCollection(NgState::all())
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
     * Return a specified state.
     *
     * @param  mixed  $ngState
     * @return \Illuminate\Http\Response
     */
    public function show(mixed $ngState)
    {
        //
        $ngState = NgState::where('id', $ngState)
        ->orWhere('name', $ngState)
        ->first();

        return $this->sendResponse([
            'state' => $ngState
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
