<?php

use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CommonController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\DoctorDegreeController;
use App\Http\Controllers\Admin\HospitalController;
use App\Http\Controllers\Admin\HospitalDoctorsController;
use App\Http\Controllers\Admin\HospitalTypesController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SpecialityController;
use App\Http\Controllers\Doctor\BlogController;
use App\Http\Controllers\Doctor\EducationController;
use App\Http\Controllers\Doctor\ExperienceController;
use App\Http\Controllers\Doctor\ScheduleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\InsuranceController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\OfferTypesController;
use App\Http\Controllers\Admin\PatientInsuranceController;
use App\Http\Controllers\Admin\ReligionsController;
use App\Http\Controllers\BlogController as HomeBlogController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Patient\AppointmentController;
use App\Http\Controllers\Patient\ReviewController;
use App\Http\Controllers\PrivacyAndTermsConditionController;
use App\Http\Controllers\Hospital\DoctorScheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/lang/change/{lang}', [HomeController::class, 'changeLang'])->name('changeLang');

Route::get('/', [HomeController::class, 'welcome']);
Route::get('/about-us', function () {
    return view('about-us');
})->name('about-us');

Route::get('/blog-list', [HomeBlogController::class, 'index'])->name('blog-list');
Route::get('/blog/{slug}',  [HomeBlogController::class, 'blogBySlug'])->name('blog');

Route::get('/blog-details', function () {
    return view('patient.blog.show');
})->name('blog_details');

Route::get('/contact-us', function () {
    return view('contact-us');
})->name('contact-us');
Route::get('/optimize', [HomeController::class, 'optimize']);
Route::get('/migrate', [HomeController::class, 'migrate']);

Route::get('link-storage', function () {
    $targetFolder = storage_path('app/public');

    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';

    symlink($targetFolder, $linkFolder);
});

// policy, terms and conditions routes

Route::post('/contactus', [PrivacyAndTermsConditionController::class, 'contactus'])->name('contactus');
Route::get('/privacy_policy', [PrivacyAndTermsConditionController::class, 'privacy'])->name('privacy');
Route::get('/terms_conditions', [PrivacyAndTermsConditionController::class, 'termsAndconditions'])->name('terms-conditions');

// Patient Routes
Route::get('single-doctor', [HomeController::class, 'single_search_doctor'])->name('single_search_doctor');
Route::get('search-doctor', [HomeController::class, 'search_doctor'])->name('search_doctor');
Route::get('search-doctor-index', [HomeController::class, 'search_doctor_index'])->name('search_doctor_index');
Route::get('search-pharmacy', [HomeController::class, 'search_pharmacy'])->name('search_pharmacy');
Route::get('doctors/{doctor}/profile', [HomeController::class, 'doctor_profile'])->name('doctor_profile');
Route::get('hospitals/{hospital}/profile', [HomeController::class, 'hospital_profile'])->name('hospital_profile');
Route::get('hospitals/{hospital}/doctors', [HomeController::class, 'hospital_doctors'])->name('hospital_doctors');
Route::get('hospitals/{hospital}/specialties', [HomeController::class, 'hospital_specialties'])->name('hospital_specialties');
Route::get('hospitals/{hospital}/offers', [HomeController::class, 'hospital_offers'])->name('hospital_offers');
Route::post('/subscribe_newsletter', [HomeController::class, 'subscribeNewsletter']);

// main search
Route::get('get-states', [StateController::class, 'get_states'])->name('get.states');
Route::get('get-cities', [CityController::class, 'get_cities'])->name('get.cities');
Route::get('get-insurances', [InsuranceController::class, 'get_insurances'])->name('get.insurances');
Route::get('get-specialities', [SpecialityController::class, 'get_specialities'])->name('get.specialities');



Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/contactus-list', [HomeController::class, 'contactuslist'])->name('contactuslist');

    // Change Password
    Route::get('change-password', [CommonController::class, 'change_password'])->name('change_password');
    Route::post('store_new_password', [CommonController::class, 'store_new_password'])->name('store_new_password');
    Route::get('newsletters', [CommonController::class, 'newsletters'])->name('newsletters');

    // Offers
    Route::resource('offers', OfferController::class);
    Route::resource('offer-types', OfferTypesController::class);
    Route::post('/offer-types/{id}/toggle-status', [OfferTypesController::class, 'toggleActive']);


    // notifications
    Route::resource('insurances', InsuranceController::class);
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

    // Admin Routes
    Route::resource('hospitalDoctors', HospitalDoctorsController::class);
    // Reports
    Route::get('appointment-reports', [ReportController::class, 'appointment_reports'])->name('appointment_reports');
    Route::get('income-reports', [ReportController::class, 'income_reports'])->name('income_reports');
    Route::get('invoice-reports', [ReportController::class, 'invoice_reports'])->name('invoice_reports');
    Route::get('user_reports', [ReportController::class, 'user_reports'])->name('user_reports');


    Route::post('doctor/import', [DoctorController::class, 'import'])->name('doctor.import');

    Route::resource('speciality', SpecialityController::class);
    Route::resource('hospital', HospitalController::class);
    Route::post('/hospitals/{id}/toggle-active', [HospitalController::class, 'toggleActive']);
    Route::resource('doctor', DoctorController::class);
    Route::post('/doctor/{id}/toggle-active', [DoctorController::class, 'toggleActive']);
    Route::resource('banner', BannerController::class);
    Route::resource('patient', PatientController::class);
    Route::resource('hospital-types', HospitalTypesController::class);
    Route::resource('docotr-degree', DoctorDegreeController::class);
    Route::get('docotr-degree/restore/{id}', [DoctorDegreeController::class, 'restore'])->name('docotr-degree.restore');
    Route::delete('docotr-degree/force-delete/{id}', [DoctorDegreeController::class, 'forceDelete'])->name('docotr-degree.force-delete');

    Route::resource('currency', CurrencyController::class);
    Route::get('currency/restore/{id}', [CurrencyController::class, 'restore'])->name('currency.restore');
    Route::delete('currency/force-delete/{id}', [CurrencyController::class, 'forceDelete'])->name('currency.force-delete');

    Route::resource('religions', ReligionsController::class);
    Route::get('hospital-patients/{hospital}/list', [CommonController::class, 'hospital_patients'])->name('hospital_patients');
    Route::get('doctor-patients/{doctor}/list', [CommonController::class, 'doctor_patients'])->name('doctor_patients');
    Route::resource('profile', ProfileController::class);
    Route::get('settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('save-settings', [SettingsController::class, 'store'])->name('store_settings');
    // Route::get('social',[SettingsController::class,'social'])->name('social');

    Route::get('schedule-settings', [CommonController::class, 'schedule_settings'])->name('schedule_settings');
    Route::post('store-schedule-settings', [CommonController::class, 'store_schedule_setting'])->name('store_schedule_settings');

    //Doctor route
    Route::resource('education', EducationController::class);
    Route::resource('experience', ExperienceController::class);
    Route::resource('schedule', ScheduleController::class);

    //cities & countries
    Route::resource('countries', CountryController::class);
    Route::resource('states', StateController::class);
    Route::resource('cities', CityController::class);

    // Extra routes for restore and force delete
    Route::get('countries/restore/{id}', [CountryController::class, 'restore'])->name('countries.restore');
    Route::delete('countries/force-delete/{id}', [CountryController::class, 'forceDelete'])->name('countries.force-delete');
    Route::get('states/restore/{id}', [StateController::class, 'restore'])->name('states.restore');
    Route::delete('states/force-delete/{id}', [StateController::class, 'forceDelete'])->name('states.force-delete');
    Route::get('cities/restore/{id}', [CityController::class, 'restore'])->name('cities.restore');
    Route::delete('cities/force-delete/{id}', [CityController::class, 'forceDelete'])->name('cities.force-delete');


    //Blogs Route
    Route::get('blogs', [BlogController::class, 'index'])->name('blogs');
    Route::get('blogs/create-blog', [BlogController::class, 'create'])->name('create_blog');
    Route::post('store-blog', [BlogController::class, 'store'])->name('store_blog');
    Route::get('blogs/{blog}/edit', [BlogController::class, 'edit'])->name('edit_blog');
    Route::patch('update-blog/{blog}/update', [BlogController::class, 'update'])->name('update_blog');
    Route::get('blogs/{blog}/details', [BlogController::class, 'show'])->name('show_blog');
    Route::delete('blogs/{blog}/blog', [BlogController::class, 'destroy'])->name('delete_blog');

    // doctor services
    Route::get('doctor-services', [CommonController::class, 'doctor_services'])->name('doctor_services');
    Route::post('add-doctor-services', [CommonController::class, 'store_services'])->name('store_services');
    // doctor specializations
    Route::get('doctor-specialization', [CommonController::class, 'doctor_specializations'])->name('doctor_specialization');
    Route::post('add-doctor-specialization', [CommonController::class, 'store_specialization'])->name('store_specializations');
    // Clinic Details
    Route::get('add-new-clinic', [CommonController::class, 'clinic_details'])->name('doctor_clinic');
    Route::post('store-new-clinic', [CommonController::class, 'store_clinic'])->name('store_clinic');

    //FOR ADMIN and HOSPITAL START
    // Repeat Schdule
    Route::get("/hospital/{doctor}/doctor-schedule", [DoctorScheduleController::class, "regularAvailabiltiyCreate"])->name("hospital.doctor-schedule.regular");
    Route::post("/hospital/{doctor}/doctor-schedule", [DoctorScheduleController::class, "regularAvailabiltiySave"]);
    Route::get("/hospital/{doctor}/doctor-schedule/edit", [DoctorScheduleController::class, "regularAvailabiltiyEdit"])->name("hospital.doctor-schedule.regular.edit");
    Route::post("/hospital/{doctor}/doctor-schedule/update", [DoctorScheduleController::class, "regularAvailabiltiyUpdate"])->name("hospital.doctor-schedule.regular.update");
    Route::post("/hospital/{doctor}/doctor-schedule/clear-all", [DoctorScheduleController::class, "regularAvailabiltiyDestroy"])->name("hospital.doctor-schedule.regular.destroy");

    // OneTime Schdule
    Route::get("/hospital/{doctor}/doctor-schedule/onetime", [DoctorScheduleController::class, "oneTimeAvailabiltiyCreate"])->name("hospital.doctor-schedule.onetime");
    Route::post("/hospital/{doctor}/doctor-schedule/onetime", [DoctorScheduleController::class, "oneTimeAvailabiltiySave"]);
    Route::get("/hospital/{doctor}/doctor-schedule/onetime/{date}/edit", [DoctorScheduleController::class, "oneTimeAvailabiltiyEdit"])->name("hospital.doctor-schedule.onetime.edit");
    Route::post("/hospital/{doctor}/doctor-schedule/onetime/{date}/update", [DoctorScheduleController::class, "oneTimeAvailabiltiyUpdate"])->name("hospital.doctor-schedule.onetime.update");
    Route::post("/hospital/{doctor}/doctor-schedule/onetime/{date}/delete", [DoctorScheduleController::class, "oneTimeAvailabiltiyDestroy"])->name("hospital.doctor-schedule.onetime.delete");

    // Unvailability Schdule
    Route::get("/hospital/{doctor}/doctor-schedule/unvailability", [DoctorScheduleController::class, "unAvailabiltiyCreate"])->name("hospital.doctor-schedule.unavailability");
    Route::post("/hospital/{doctor}/doctor-schedule/unvailability", [DoctorScheduleController::class, "unAvailabiltiySave"]);
    Route::get("/hospital/{doctor}/doctor-schedule/unvailability/{date}/edit", [DoctorScheduleController::class, "unAvailabiltiyEdit"])->name("hospital.doctor-schedule.unavailability.edit");
    Route::post("/hospital/{doctor}/doctor-schedule/unvailability/{date}/update", [DoctorScheduleController::class, "unAvailabiltiyUpdate"])->name("hospital.doctor-schedule.unavailability.update");
    Route::post("/hospital/{doctor}/doctor-schedule/unvailability/{date}/delete", [DoctorScheduleController::class, "unAvailabiltiyDestroy"])->name("hospital.doctor-schedule.unavailability.delete");
    //FOR ADMIN and HOSPITAL END

    //FOR DOCTOR start
    // Repeat Schdule
    Route::get("/doctor/{doctor}/doctor-schedule", [ScheduleController::class, "regularAvailabiltiyCreate"])->name("doctor.doctor-schedule.regular");
    Route::post("/doctor/{doctor}/doctor-schedule", [ScheduleController::class, "regularAvailabiltiySave"]);
    Route::get("/doctor/{doctor}/doctor-schedule/edit", [ScheduleController::class, "regularAvailabiltiyEdit"])->name("doctor.doctor-schedule.regular.edit");
    Route::post("/doctor/{doctor}/doctor-schedule/update", [ScheduleController::class, "regularAvailabiltiyUpdate"])->name("doctor.doctor-schedule.regular.update");
    Route::post("/doctor/{doctor}/doctor-schedule/clear-all", [ScheduleController::class, "regularAvailabiltiyDestroy"])->name("doctor.doctor-schedule.regular.destroy");

    // OneTime Schdule
    Route::get("/doctor/{doctor}/doctor-schedule/onetime", [ScheduleController::class, "oneTimeAvailabiltiyCreate"])->name("doctor.doctor-schedule.onetime");
    Route::post("/doctor/{doctor}/doctor-schedule/onetime", [ScheduleController::class, "oneTimeAvailabiltiySave"]);
    Route::get("/doctor/{doctor}/doctor-schedule/onetime/{date}/edit", [ScheduleController::class, "oneTimeAvailabiltiyEdit"])->name("doctor.doctor-schedule.onetime.edit");
    Route::post("/doctor/{doctor}/doctor-schedule/onetime/{date}/update", [ScheduleController::class, "oneTimeAvailabiltiyUpdate"])->name("doctor.doctor-schedule.onetime.update");
    Route::post("/doctor/{doctor}/doctor-schedule/onetime/{date}/delete", [ScheduleController::class, "oneTimeAvailabiltiyDestroy"])->name("doctor.doctor-schedule.onetime.delete");

    // Unvailability Schdule
    Route::get("/doctor/{doctor}/doctor-schedule/unvailability", [ScheduleController::class, "unAvailabiltiyCreate"])->name("doctor.doctor-schedule.unavailability");
    Route::post("/doctor/{doctor}/doctor-schedule/unvailability", [ScheduleController::class, "unAvailabiltiySave"]);
    Route::get("/doctor/{doctor}/doctor-schedule/unvailability/{date}/edit", [ScheduleController::class, "unAvailabiltiyEdit"])->name("doctor.doctor-schedule.unavailability.edit");
    Route::post("/doctor/{doctor}/doctor-schedule/unvailability/{date}/update", [ScheduleController::class, "unAvailabiltiyUpdate"])->name("doctor.doctor-schedule.unavailability.update");
    Route::post("/doctor/{doctor}/doctor-schedule/unvailability/{date}/delete", [ScheduleController::class, "unAvailabiltiyDestroy"])->name("doctor.doctor-schedule.unavailability.delete");

    // for doctor end


    // Review
    Route::post('add-review', [ReviewController::class, 'store'])->name('add_review');
    Route::get('reviews', [ReviewController::class, 'index'])->name('reviews');

    //ADMIN REVIEWS

    // Patient Insurance Details
    Route::get('patient/insurance-details/{patient_id}', [PatientInsuranceController::class, 'show'])->name('patient_insurance.show');
    Route::patch('patient/insurance-details/{patient_id}', [PatientInsuranceController::class, 'update'])->name('patient_insurance.update');


    // Patient Appointments
    Route::get('appointment/{doctor}/create', [AppointmentController::class, 'create_appointment'])->name('create_appointment');
    Route::post('store-appointment', [AppointmentController::class, 'store_appointment'])->name('store_appointment');
    Route::get('appointments', [AppointmentController::class, 'manage_appointments'])->name('appointments');
    Route::patch('appointments/{appointment}/update', [AppointmentController::class, 'update_apt_status'])->name('update_appointment_status');
    Route::get('appointment/{doctor}/availability', [AppointmentController::class, 'get_availability'])->name('get_availability');

    Route::get('update-appointment/{id}', [AppointmentController::class, 'update_appointment'])->name('update-appointment');
    Route::put('update-appointment/{id}', [AppointmentController::class, 'save_update_appointment'])->name('save_update_appointment');


    // Route::resource('patient-profile', AppointmentController::class);

    // Invoice Routes
    Route::get('invoices', [AppointmentController::class, 'invoice'])->name('invoices');
    Route::get('invoices/{invoice}/view', [AppointmentController::class, 'show_invoice'])->name('show_invoice');
    Route::get('invoices/{invoice}/download', [AppointmentController::class, 'invoice_download'])->name('invoice.download');
    Route::get('invoices/qrcode', [AppointmentController::class, 'qrcode'])->name('invoice.qrcode');
    Route::get('admin/invoices/{invoice}/download-xml', [AppointmentController::class, 'downloadXml'])->name('invoice.download.xml');


    // Patient Dashboard
    // Route::get('/patient-dashboard', function (){
    //     return view('patient.patient-dashboard');
    // })->name('patient_dashboard');
    Route::get('/patient-dashboard', [HomeController::class, 'patientDashboard'])->name('patient_dashboard');
    Route::get('/patient-dashboard/insurance-details', [PatientInsuranceController::class, 'showForPatient'])->name('patient_dashboard.insurance_details');


    // delete account routes
    Route::get('/delete-account', [HomeController::class, 'showDeleteAccount'])->name('show.delete.account');
    Route::post('/delete-account', [HomeController::class, 'deleteAccount'])->name('delete.account');
});

require __DIR__ . '/auth.php';

// new page
Route::get('new-home', function () {
    return view('web.home');
});

