<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisualAcuityFarController;
use App\Http\Controllers\VisualAcuityNearController;
use App\Http\Controllers\RefractionAxisController;
use App\Http\Controllers\RefractionSphereController;
use App\Http\Controllers\RefractionCylinderController;
use App\Http\Controllers\RefractionPrismController;
use App\Http\Controllers\ChiefComplaintController;
use App\Http\Controllers\DiagnosisListController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\ConsultingController;
use App\Http\Controllers\ContinueConsultingController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/visual_acuity_far', [VisualAcuityFarController::class, 'retrieveAll']);
Route::post('/visual_acuity_far', [VisualAcuityFarController::class, 'store']);

Route::get('/visual_acuity_near', [VisualAcuityNearController::class, 'retrieveAll']);
Route::post('/visual_acuity_near', [VisualAcuityNearController::class, 'store']);

Route::get('/refraction_cylinder', [RefractionCylinderController::class, 'retrieveAll']);
Route::post('/refraction_cylinder', [RefractionCylinderController::class, 'store']);

Route::get('/refraction_prism', [RefractionPrismController::class, 'retrieveAll']);
Route::post('/refraction_prism', [RefractionPrismController::class, 'store']);

Route::get('/refraction_axis', [RefractionAxisController::class, 'retrieveAll']);
Route::post('/refraction_axis', [RefractionAxisController::class, 'store']);

Route::get('/refraction_sphere', [RefractionSphereController::class, 'retrieveAll']);
Route::post('/refraction_sphere', [RefractionSphereController::class, 'store']);

Route::get('/diagnosis_list', [DiagnosisListController::class, 'retrieveAll']);
Route::post('/diagnosis_list', [DiagnosisListController::class, 'store']);

Route::get('/chief_complaint', [ChiefComplaintController::class, 'retrieveAll']);
Route::post('/chief_complaint', [ChiefComplaintController::class, 'store']);

Route::get('/doctors', [DoctorsController::class, 'retrieveAll']);
Route::post('/doctors', [DoctorsController::class, 'store']);

Route::get('/patients', [PatientsController::class, 'retrieveAll']);
Route::get('/patients/search', [PatientsController::class, 'searchPatient']);
Route::post('/patients', [PatientsController::class, 'store']);

Route::get('/users', [UsersController::class, 'retrieveAll']);
Route::post('/users', [UsersController::class, 'store']);

Route::get('/consulting', [ConsultingController::class, 'retrieveAll']);
Route::post('/consulting', [ConsultingController::class, 'store']);

Route::get('/continue_consulting', [ContinueConsultingController::class, 'retrieveAll']);
Route::post('/continue_consulting', [ContinueConsultingController::class, 'store']);