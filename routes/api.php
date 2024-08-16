<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\api\CommonController;
use App\Http\Controllers\Api\MainController;

// use Illuminate\Support\Facades\File;
// use Illuminate\Support\Facades\Response;

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

// MainController
Route::get('specialities',[MainController::class,'allSpecialities']);
Route::get('cities',[MainController::class,'allCities']);
Route::get('insurances',[MainController::class,'get_insurances']);
Route::get('doctors',[MainController::class,'DoctorWithFilter']);
Route::get('doctor-profile/{id}',[MainController::class,'DoctorProfile']);
Route::get('availability/{id}',[MainController::class,'get_availability']);
Route::get('best-doctors',[MainController::class,'bestsDoctors']);

Route::get('hospitals',[CommonController::class,'Hospitals']);
Route::get('available-doctors',[CommonController::class,'AvailableDoctors']);
Route::get('specialist/{id}',[CommonController::class,'SpecialityDoctors']);
Route::get('hospitals-by-filter',[CommonController::class,'HospitalsByFilter']);

// Route::get('images/{name}', function ($name) {
//     $path = public_path('images/' . $name);

//     if (!File::exists($path)) {
//         return $this->ErrorResponse(404, 'Image not found.');
//     }
//     $file = File::get($path);
//     $type = File::mimeType($path);
//     $response = Response::make($file, 200);
//     $response->header("Content-Type", $type);

//     return $response;    
// });

Route::middleware(['auth:sanctum','patient'])->group( function () {
    
    Route::post('app-setting',[MainController::class,'updateOrCreateAppSetting']);

    Route::post('book-appointment',[CommonController::class,'BookAppointment']);
    Route::get('patient-appointments',[CommonController::class,'PatientAppointments']);
    Route::post('add-to-wishlist',[CommonController::class,'AddToWishlist']);
    Route::get('wishlist',[CommonController::class,'Wishlist']);
    Route::post('cancel-appointment',[CommonController::class,'CancelAppointment']);

    Route::get('profile',[AuthController::class,'PatientProfile']);
    Route::post('update-profile',[AuthController::class,'UpdatePatientProfile']);

});