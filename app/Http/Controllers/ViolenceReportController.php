<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViolenceReport;
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreViolenceReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreViolenceReportRequest $request)
    {
        //
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
