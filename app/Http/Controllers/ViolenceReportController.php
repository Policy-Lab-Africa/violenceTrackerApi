<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreViolenceReportRequest;
use App\Http\Requests\UpdateViolenceReportRequest;
use App\Models\ViolenceReport;
use App\Models\NgState;
use App\Models\NgLocalGovernment;
use App\Models\NgPollingUnit;
use App\Models\ViolenceType;

class ViolenceReportController extends Controller
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
     * Store a newly created violence report.
     * 
     * This endpoint creates a new violence report with the inputs passed and returns an object of the newly created  violence report.
     * 
     * @param  \App\Http\Requests\StoreViolenceReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreViolenceReportRequest $request)
    {
        // return 'This is violence report route';
        $request->validated();

        return $this->sendResponse([
            'violence_report' => ViolenceReport::create([
                'ng_state_id' => $request->ng_state_id,
                'ng_local_government_id' => $request->ng_local_government_id,
                'ng_polling_unit' => $request->ng_polling_unit,
                'type_id' => $request->type_id,
                'title' => $request->title,
                'description' => $request->description,
                'file' => !$request->has('file') ?: $request->file('file')
                            ->store('report-files-'.date('m-Y'), 's3'),
            ])
         ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ViolenceReport  $violenceReport
     * @return \Illuminate\Http\Response
     */
    public function show(ViolenceReport $violenceReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ViolenceReport  $violenceReport
     * @return \Illuminate\Http\Response
     */
    public function edit(ViolenceReport $violenceReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateViolenceReportRequest  $request
     * @param  \App\Models\ViolenceReport  $violenceReport
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateViolenceReportRequest $request, ViolenceReport $violenceReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ViolenceReport  $violenceReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(ViolenceReport $violenceReport)
    {
        //
    }
}
