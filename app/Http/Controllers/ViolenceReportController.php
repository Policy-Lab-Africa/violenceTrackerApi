<?php

namespace App\Http\Controllers;

use App\Models\NgState;
use App\Models\ViolenceType;
use Illuminate\Http\Request;
use App\Models\NgPollingUnit;
use Illuminate\Http\Response;
use App\Models\ViolenceReport;
use App\Models\NgLocalGovernment;
use App\Events\ViolenceReportCreated;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ViolenceReportCollection;
use App\Http\Requests\StoreViolenceReportRequest;
use App\Http\Requests\UpdateViolenceReportRequest;


class ViolenceReportController extends Controller
{
    /**
     * Get violence reports
     * 
     * Returns violence reports from storage ordered by `created_at` `desc`. By default this endpoint returns 100 reports. You can increase this by adding a (int)`limit` query parameter
     * 
     * @group Violence Reports
     * 
     * @queryParam limit an integer
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'limit' => 'nullable|integer'
        ]);
        //
        $violenceReportQuery = ViolenceReport::latest();
        
        $violenceReportQuery = $request->has('limit') ? $violenceReportQuery->paginate($request->limit) : $violenceReportQuery->paginate(100);
        
        $violenceReports = new ViolenceReportCollection(
            $violenceReportQuery
        );

        return $this->sendResponse([
            'violence_reports' => $violenceReports
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Create a violence report
     * 
     * This endpoint creates a new violence report with the inputs passed and returns an object of the newly created  violence report.
     * 
     * @group Violence Reports
     * 
     * @bodyParam ng_state_id int `ng_states.data_id`  
     * @bodyParam ng_local_government_id int `ng_local_governments.data_id` 
     * @bodyParam ng_polling_unit_id int required `ng_polling_units.data_id` 
     * @bodyParam title string  
     * @bodyParam description string The `description` property is required if no file is attached
     * @bodyParam file file The `file` property is required if there's no description
     *  
     * @param  \App\Http\Requests\StoreViolenceReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreViolenceReportRequest $request)
    {
        // return 'This is violence report route';
        $request->validated();

        try{

            $report = ViolenceReport::create([
                'ng_state_id' => $request->ng_state_id,
                'ng_local_government_id' => $request->ng_local_government_id,
                'ng_polling_unit_id' => $request->ng_polling_unit_id,
                'type_id' => $request->type_id,
                'title' => $request->title,
                'description' => $request->description,
                'file' => $request->has('file') ? $request->file('file')->store('report-files-'.date('m-Y'), 's3') : null,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'longitude' => $request->longitude,
                'latitude' => $request->latitude,
            ]);

            ViolenceReportCreated::dispatch($report);
    
            return $this->sendResponse(['violence_report' => $report], 201);

        } catch (Throwable $th)
        {
            Log::critical('CreateReportFailed', [
                'exception' => $th
            ]);

            return $this->sendError([
                'violence_report' => 'Something went wrong!']);
        }

        
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
