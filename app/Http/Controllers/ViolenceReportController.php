<?php

namespace App\Http\Controllers;

use App\Models\NgState;
use App\Models\ViolenceType;
use Illuminate\Http\Request;
use App\Models\NgPollingUnit;
use Illuminate\Http\Response;
use App\Models\ViolenceReport;
use App\Models\NgLocalGovernment;
use Illuminate\Support\Facades\App;
use App\Events\ViolenceReportCreated;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ReportDataRequest;
use App\Http\Resources\ViolenceReportCollection;
use App\Http\Requests\StoreViolenceReportRequest;
use App\Http\Requests\UpdateViolenceReportRequest;
use App\Services\ViolenceReport\ReportDataService;


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

            $report = ViolenceReport::updateOrcreate([
                'ng_polling_unit_id' => $request->ng_polling_unit_id,
                'description' => $request->description,
                'ip_address' => $request->ip(),
            ],
            [
                'type_id' => $request->type_id,
                'title' => $request->title,
                'ng_state_id' => $request->ng_state_id,
                'ng_local_government_id' => $request->ng_local_government_id,
                'file' => $request->has('file') ? $request->file('file')->store('report-files-'.date('m-Y'), 's3') : null,
                'user_agent' => $request->userAgent(),
                'longitude' => $request->longitude,
                'latitude' => $request->latitude,
            ]);

            if (App::environment(['production', 'testing'])) {
                ViolenceReportCreated::dispatch($report);       
            }
    
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
     * Fetch a report By ID
     * 
     * This endpoint returns a single report identified by `violence_reports.id`
     * 
     * @group Violence Reports
     *
     * @param  \App\Models\ViolenceReport  $violenceReport
     * @return \Illuminate\Http\Response
     */
    public function show(ViolenceReport $violenceReport)
    {
        return $this->sendResponse(['violence_report' => $violenceReport]);
    }
    
    /**
     * Fetch Report Data
     * 
     * It returns data for a specified location. Your search term will be searched against the name fied of the following objects `ng_states`, `ng_local_governments`, `ng_wards`, `ng_polling_units`. Data will be returned if `violence_reports` are found for a location that matches your search term
     * 
     * @bodyParam q string required The search location search term. Should match state, local government area, ward or polling unit.
     * 
     * @responseField state_results array If search term matches a state, the data for the state will be returned in this array
     * 
     * @responseField local_government_results array If search term matches a local government area, the data for the LGA will be returned in this array
     * 
     * @responseField ward_results array If search term matches a ward, the data for the ward will be returned in this array
     * 
     * @responseField polling_unit_results array If search term matches a polling unit, the data for the polling unit will be returned in this array
     * 
     * @responseField {location}_results.data array The state, local government(s), wards, or polling units, that have polling units with violence_reports
     * 
     * @responseField {location}_results.meta_data object The summary of the data in `{location}_results.data`
     * 
     * @responseField {location}_results.meta_data.violence_reports.count integer The total number of reports. Can be useful to determine if `{location}_results.data` is empty, without actually checking through the array.
     * 
     * @responseField {location}_results.meta_data.polling_units.count integer The total number of unique polling units with `violence_reports`.
     * 
     * @responseField {location}_results.meta_data.local_governments.data array The unique local governments with `violence_reports`.
     * @responseField {location}_results.meta_data.local_governments.count_unique integer The total of unique local governments with `violence_reports`.
     * @responseField {location}_results.meta_data.local_governments.count_reports object Count of violence reports grouped by `ng_local_governments.data_id`. { _ng_local_government.data_id_"123": _count of violence_reports_ 20}
     * 
     * @responseField {location}_results.meta_data.types.count_unique integer The total of unique violence types.
     * 
     * @responseField {location}_results.meta_data.types.count_reports object Count of violence reports grouped by `violence_types.data_id`. { _violence_types.id_"123": _count of violence_reports_ 20 }
     * 
     * @group Violence Reports
     *
     * @param ReportDataRequest $request
     * @return void
     */
    public function showData(ReportDataRequest $request)
    {
        $request->validated();
        
       return $this->sendResponse((new ReportDataService($request->q, $request->start, $request->end))
        ->searchPollingUnit()
        ->searchWard()
        ->searchLocalGovernment()
        ->searchState()
        ->formatResult());
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
