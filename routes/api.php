<?php
use App\Http\Controllers\AuthController;
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
use App\Http\Controllers\EncountersController;
use App\Http\Controllers\RefractionController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\MedicinesController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\SketchController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\InvestigationController;
use App\Http\Controllers\HMOsController;
use App\Http\Controllers\ManufacturersController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\NearAddController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController; 
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;
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

Route::get('/near_add', [NearAddController::class, 'retrieveAll']);
Route::post('/near_add', [NearAddController::class, 'store']);


Route::get('/diagnosis_list', [DiagnosisListController::class, 'retrieveAll']);
Route::post('/diagnosis_list', [DiagnosisListController::class, 'store']);

Route::get('/chief_complaint', [ChiefComplaintController::class, 'retrieveAll']);
Route::post('/chief_complaint', [ChiefComplaintController::class, 'store']);

Route::get('/doctors', [DoctorsController::class, 'retrieveAll']);
Route::post('/doctors', [DoctorsController::class, 'store']);

Route::get('/hmos', [HMOsController::class, 'retrieveAll']);
Route::post('/hmos', [HMOsController::class, 'store']);

Route::get('/patients', [PatientsController::class, 'retrieveAll']);
Route::get('/patients/search', [PatientsController::class, 'searchPatient']);
Route::post('/patients', [PatientsController::class, 'store']);
Route::get('/patients-all', [PatientsController::class, 'retrieveAllPatients']);
Route::put('/patient/{patientId}', [PatientsController::class, 'update']);
Route::delete('/patient/{patientId}', [PatientsController::class, 'deletePatient']);


Route::get('/users', [UsersController::class, 'retrieveAll']);
Route::post('/users', [UsersController::class, 'store']);
Route::get('/users/doctors', [UsersController::class, 'doctors']);
Route::get('/users/nurses', [UsersController::class, 'nurses']);
Route::get('/users/clinic_receptionists', [UsersController::class, 'clinic_receptionists']);
Route::get('/users/workshop_receptionists', [UsersController::class, 'workshop_receptionists']);
Route::get('/users/front_desks', [UsersController::class, 'front_desk']);
Route::delete('/user/{id}', [UsersController::class, 'deleteUser']);
Route::put('/user/{id}', [UsersController::class, 'updateUser']);


Route::get('/roles', [RolesController::class, 'retrieveAll']);
Route::post('/roles', [RolesController::class, 'store']);

Route::get('/appointments', [AppointmentsController::class, 'retrieveAll']);
Route::post('/appointments', [AppointmentsController::class, 'store']);
Route::post('/encounter-appointment', [AppointmentsController::class, 'createEncounterAppointment']);
Route::delete('/appointments/{appointmentId}', [AppointmentsController::class, 'deleteAppointment']);
Route::put('/appointments/{appointmentId}', [AppointmentsController::class, 'updateAppointment']);


// Route::get('/medicines', [MedicinesController::class, 'retrieveAll']);
Route::post('/medicines', [MedicinesController::class, 'store']);
Route::put('/medicines/{medicineId}', [MedicinesController::class, 'update']);
Route::delete('/medicines/{medicineId}', [MedicinesController::class, 'deleteMedicine']);

Route::get('/manufacturers', [ManufacturersController::class, 'retrieveAll']);
Route::post('/manufacturers', [ManufacturersController::class, 'store']);
Route::put('/manufacturers/{manufacturerId}', [ManufacturersController::class, 'update']);
Route::delete('/manufacturers/{manufacturerId}', [ManufacturersController::class, 'deleteManufacturer']);



Route::get('/medicines', [ProductController::class, 'retrieveMedicines']);
Route::get('/eyedrops', [ProductController::class, 'eyeDrops']);
Route::get('/tablets', [ProductController::class, 'tablets']);
Route::get('/ointments', [ProductController::class, 'ointments']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', [ProductController::class, 'retrieveAll']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'deleteProduct']); 
    
    Route::get('/lenses', [ProductController::class, 'retrieveLenses']);
    Route::get('/frames', [ProductController::class, 'retrieveFrames']);
    Route::get('/accessories', [ProductController::class, 'retrieveAccessories']);

   
    Route::get('/services', [ServiceController::class, 'retrieveAll']);
    Route::get('/services', [ServiceController::class, 'retrieveAll']);
    Route::post('/services', [ServiceController::class, 'store']);
    Route::put('/services/{id}', [ServiceController::class, 'update']);
    Route::delete('/services/{id}', [ServiceController::class, 'deleteService']); 
    
    Route::get('/inventories', [InventoryController::class, 'retrieveAll']);
    Route::post('/inventories', [InventoryController::class, 'store']);
    Route::put('/inventories/{id}', [InventoryController::class, 'update']);
    Route::delete('/inventories/{id}', [InventoryController::class, 'deleteInventory']); 
   
    Route::get('/medicine-inventories', [InventoryController::class, 'retrieveMedicines']);
    Route::get('/lenses-inventories', [InventoryController::class, 'retrieveLenses']);
    Route::get('/frames-inventories', [InventoryController::class, 'retrieveFrames']);
    Route::get('/accessories-inventories', [InventoryController::class, 'retrieveAccessories']);

    Route::get('/product-billing-inventories', [InventoryController::class, 'billingInventory']);
    Route::get('/service-billing-inventories', [ServiceController::class, 'serviceInventory']);

    Route::post('/bill-patient', [BillingController::class, 'store']);
    Route::post('/confirm-payment', [BillingController::class, 'updateBillingStatus']);

    Route::get('/billings', [BillingController::class, 'retrieveAll']);
Route::post('/billings', [BillingController::class, 'store']);
Route::put('/billings/{id}', [BillingController::class, 'update']);
Route::delete('/billings/{transactionId}', [BillingController::class, 'deleteBilling']);
// Route::delete('/billings', [BillingController::class, 'delete']);
});
Route::get('/print-receipt/{transactionId}', [BillingController::class, 'printBilling']);


Route::get('/consulting', [ConsultingController::class, 'retrieveAll']);
Route::post('/consulting', [EncountersController::class, 'store']);

Route::get('/continue_consulting', [ContinueConsultingController::class, 'retrieveAll']);
Route::post('/continue_consulting', [ContinueConsultingController::class, 'store']);

Route::get('/refraction', [RefractionController::class, 'retrieveAll']);
Route::post('/refraction', [RefractionController::class, 'store']);

Route::get('/encounters', [EncountersController::class, 'retrieveAll']);
Route::post('/encounters', [EncountersController::class, 'store']);

Route::get('/diagnosis', [DiagnosisController::class, 'retrieveAll']);
Route::post('/diagnosis', [DiagnosisController::class, 'store']);

Route::post('/sketch', [SketchController::class, 'saveSketches']);

Route::post('/treatment', [TreatmentController::class, 'saveTreatments']);

Route::post('/investigations', [InvestigationController::class, 'store']);



Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->post('/change-password', [AuthController::class, 'changePassword']);
Route::put('/update-profile', [AuthController::class, 'updateProfile']);

Route::get('/prescriptions', [TreatmentController::class, 'getPrescriptions']);

Route::get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);