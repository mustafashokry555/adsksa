<?php

use App\Http\Controllers\Api\AppointController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BillingController;
use App\Http\Controllers\api\CommonController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\FilterController;
use App\Http\Controllers\Api\HospitalController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\OfferTypesController;
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
Route::post('login/verify',[AuthController::class,'verify_login_otp']);
Route::post('password/email', [AuthController::class, 'sendResetPasswordEmail']);
Route::post('password/verify-otp', [AuthController::class, 'verifyRestPasswprdOtp']);
Route::post('password/reset', [AuthController::class, 'resetPassword']);

// Basic data
Route::get('home',[MainController::class,'home']);
Route::get('offers',[MainController::class,'offers']);
Route::get('offer-types',[OfferTypesController::class,'offerTypes']);
Route::get('offer-types/{id}',[OfferTypesController::class,'offerTypeDetails']);
Route::get('banners',[MainController::class,'banners']);
Route::get('religions', [MainController::class, 'getReligions']);
Route::get('insurances',[MainController::class,'get_insurances']);
Route::get('specialities',[MainController::class,'allSpecialities']);
Route::get('countries',[MainController::class,'allCountries']);
Route::get('states',[MainController::class,'allStates']);
Route::get('cities',[MainController::class,'allCities']);

// Filter & Search
Route::get('filter-data',[FilterController::class,'filter_data']);
Route::get('search',[FilterController::class,'search']);

// Doctors
Route::get('doctors',[DoctorController::class,'DoctorWithFilter']);
Route::get('doctor-profile/{id}',[DoctorController::class,'DoctorProfile']);
Route::get('best-doctors',[DoctorController::class,'bestsDoctors']);
Route::get('specialist/{id}',[DoctorController::class,'SpecialityDoctors']);
Route::post('/makeComplaint', [DoctorController::class, 'makeComplaint']);

// Hospitals
Route::get('hospitals',[HospitalController::class,'HospitalWithFilter']);
Route::get('hospital-profile/{id}',[HospitalController::class,'hospitalProfile']);
// Route::get('HospitalsTest',[HospitalController::class,'HospitalsTest']);

// Appointment
Route::get('availability/{id}',[AppointController::class,'get_availability']);

// Settings
Route::get('privacy-policy',[SettingController::class,'privacy_policy']);
Route::get('help',[SettingController::class,'help']);



// Route::get('hospitals',[CommonController::class,'Hospitals']);
// Route::get('available-doctors',[CommonController::class,'AvailableDoctors']);
// nothing
Route::post('test-try-donot-use',[HomeController::class,'test_try_donot_use']);
Route::get('down/file',[HomeController::class,'downBackup']);

Route::middleware(['auth:sanctum','patient'])->group( function () {
    // patient app setting
    Route::post('app-setting',[SettingController::class,'updateOrCreateAppSetting']);

    // patient profile
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('profile',[AuthController::class,'PatientProfile']);
    Route::post('update-profile',[AuthController::class,'UpdatePatientProfile']);
    // update Email
    Route::post('update-email/email',[AuthController::class,'sendEmailToUpdateEmail']);
    Route::post('update-email/verify-otp',[AuthController::class,'VerifyUpdateMailOtp']);

    Route::post('change-password',[AuthController::class,'changePassword']);
    Route::post('/delete-account', [AuthController::class, 'delete_account']);
    Route::post('/profile-image', [AuthController::class, 'profile_image']);

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
        Route::post('/read/{id}', [NotificationController::class, 'markAsRead']);
        // Route::get('/{notification}', [NotificationController::class, 'show']);
    });

    // Billing
    Route::get('billing-history', [BillingController::class, 'billingHistory']);
    Route::get('billing-details/{id}', [BillingController::class, 'billingDetails']);


});
