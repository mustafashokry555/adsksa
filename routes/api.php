<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\api\CommonController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('verify',[AuthController::class,'VerifyOtp']);
Route::get('specialities',[CommonController::class,'allSpecialities']);
Route::get('hospitals',[CommonController::class,'Hospitals']);
Route::get('available-doctors',[CommonController::class,'AvailableDoctors']);
Route::get('doctor-profile/{id}',[CommonController::class,'DoctorProfile']);
Route::get('doctors',[CommonController::class,'DoctorWithFilter']);
Route::get('specialist/{id}',[CommonController::class,'SpecialityDoctors']);
Route::get('availability/{id}',[CommonController::class,'get_availability']);
Route::get('insurances',[CommonController::class,'get_insurances']);
Route::get('hospitals-by-filter',[CommonController::class,'HospitalsByFilter']);
Route::get('best-doctors',[CommonController::class,'bestsDoctors']);



Route::middleware(['auth:sanctum','patient'])->group( function () {
    
    Route::post('book-appointment',[CommonController::class,'BookAppointment']);
    Route::get('patient-appointments',[CommonController::class,'PatientAppointments']);
    Route::post('add-to-wishlist',[CommonController::class,'AddToWishlist']);
    Route::get('wishlist',[CommonController::class,'Wishlist']);
    Route::post('cancel-appointment',[CommonController::class,'CancelAppointment']);
    Route::post('update-profile',[AuthController::class,'UpdatePatientProfile']);
    Route::get('profile',[AuthController::class,'PatientProfile']);
    

});