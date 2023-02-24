<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NgWardController;
use App\Http\Controllers\NgStateController;
use App\Http\Controllers\RecaptchaController;
use App\Http\Controllers\ViolenceTypeController;
use App\Http\Controllers\NgPollingUnitController;
use App\Http\Controllers\ViolenceReportController;
use App\Http\Controllers\NgLocalGovernmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('verify', [RecaptchaController::class, 'verifyToken']);

Route::get('/violence-types', [ViolenceTypeController::class, 'index']);

Route::apiResource('states', NgStateController::class)->only([
    'index',
    'show',
]);

Route::get('states/{ngState}/lgas', [NgLocalGovernmentController::class, 'showLgas']);
Route::get('lgas/{ngLga}/wards', [NgWardController::class, 'showWards']);
Route::get('wards/{ngWard}/polling-units', [NgPollingUnitController::class, 'showPollingUnits']);

Route::get('filter', [NgStateController::class, 'inecFilter']);

Route::get('violence-reports/data', [ViolenceReportController::class, 'showData'])->name('violence-reports.show.data');
Route::apiResource('violence-reports', ViolenceReportController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
