<?php

use App\Http\Controllers\Api\AppointController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\api\CommonController;
use App\Http\Controllers\Api\FilterController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PatientInsuranceController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\HomeController;

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

// Auth
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

// Patient
Route::post('verify',[AuthController::class,'VerifyOtp']);
Route::post('password/email', [AuthController::class, 'sendResetEmail']);
Route::post('password/verify-otp', [AuthController::class, 'verifyOtp2']);
Route::post('password/reset', [AuthController::class, 'reset']);

// Filter & Search
Route::get('insurances',[MainController::class,'get_insurances']);
Route::get('specialities',[MainController::class,'allSpecialities']);
Route::get('countries',[MainController::class,'allCountries']);
Route::get('states',[MainController::class,'allStates']);
Route::get('cities',[MainController::class,'allCities']);
Route::get('filter-data',[FilterController::class,'filter_data']);
Route::get('search',[FilterController::class,'search']);

// Appointment
Route::get('availability/{id}',[AppointController::class,'get_availability']);



Route::get('doctors',[MainController::class,'DoctorWithFilter']);
Route::get('doctor-profile/{id}',[MainController::class,'DoctorProfile']);
Route::get('best-doctors',[MainController::class,'bestsDoctors']);
Route::post('/makeComplaint', [MainController::class, 'makeComplaint']);

Route::get('hospitals',[MainController::class,'HospitalsTest']);
Route::get('HospitalsTest',[MainController::class,'HospitalsTest']);
Route::get('hospital-profile/{id}',[MainController::class,'hospitalProfile']);

Route::get('home',[MainController::class,'home']);
Route::get('offers',[MainController::class,'offers']);
Route::get('banners',[MainController::class,'banners']);
Route::get('/religions', [MainController::class, 'getReligions']);


Route::get('privacy-policy',[SettingController::class,'privacy_policy']);
Route::get('help',[SettingController::class,'help']);



// Route::get('hospitals',[CommonController::class,'Hospitals']);
// Route::get('available-doctors',[CommonController::class,'AvailableDoctors']);

// nothing
Route::post('test-try-donot-use',[HomeController::class,'test_try_donot_use']);
Route::get('down/file',[HomeController::class,'downBackup']);
Route::get('specialist/{id}',[CommonController::class,'SpecialityDoctors']);

Route::middleware(['auth:sanctum','patient'])->group( function () {

    // patient profile
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('profile',[AuthController::class,'PatientProfile']);
    Route::post('update-profile',[AuthController::class,'UpdatePatientProfile']);
    Route::post('change-password',[AuthController::class,'changePassword']);
    Route::post('/delete-account', [AuthController::class, 'delete_account']);
    Route::post('/profile-image', [AuthController::class, 'profile_image']);
    Route::post('app-setting',[MainController::class,'updateOrCreateAppSetting']);

    // patient insurance
    Route::get('/patient-insurances', [PatientInsuranceController::class, 'show']);
    Route::post('/patient-insurances', [PatientInsuranceController::class, 'update']);

    
    // Favorite
    Route::post('doctor-to-wishlist',[WishlistController::class,'addDoctorToWishlist']);
    Route::post('hospital-to-wishlist',[WishlistController::class,'addHospitalToWishlist']);
    Route::get('wishlist',[WishlistController::class,'wishlist']);
    Route::get('doctor-wishlist',[WishlistController::class,'doctor_wishlist']);
    Route::get('hospital-wishlist',[WishlistController::class,'hospital_wishlist']);
    
    // Appointment
    Route::post('book-appointment',[AppointController::class,'BookAppointment']);
    Route::post('cancel-appointment',[AppointController::class,'CancelAppointment']);
    Route::get('patient-appointments',[AppointController::class,'PatientAppointments']);
    Route::get('/appointment/{id}', [AppointController::class, 'getAppointmentDetails']);

    
    // Reviews
    Route::post('add-doctor-review', [ReviewController::class, 'add_doctor_review']);
    Route::post('add-hospital-review', [ReviewController::class, 'add_hospital_review']);
    
    // notifications
    Route::prefix('notifications')->group(function () {
        Route::get('/', [NotificationController::class, 'index']);
        // Route::get('/{notification}', [NotificationController::class, 'show']);
        Route::post('/read/{id}', [NotificationController::class, 'markAsRead']);
    });

});