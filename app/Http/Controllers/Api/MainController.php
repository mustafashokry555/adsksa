<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Insurance;
use App\Models\Hospital;
use App\Models\Appointment;
use App\Models\Specialization;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Unavailability;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class MainController extends Controller
{
    protected $lang;

    public function __construct(Request $request)
    {
        $this->lang = $request->header('lang', 'en');
    }
    // API for Update Or Create App Setting (Done)
    public function updateOrCreateAppSetting(Request $request)
    {
        try {
            $request->validate([
                'notifications' => 'nullable|boolean',
                'msg_option' => 'nullable|boolean',
                'call_option' => 'nullable|boolean',
                'video_call_option' => 'nullable|boolean',
            ]);
            $user = $request->user();

            $AppSetting = AppSetting::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'notifications' => $request->notifications ?? '0',
                    'msg_option' => $request->msg_option ?? '0',
                    'call_option' => $request->call_option ?? '0',
                    'video_call_option' => $request->video_call_option ?? '0',
                ]
            );

            return $this->SuccessResponse(200, null, $AppSetting);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }
    /* Start Search For Doctors APIs*/
    // API for All Specialities (Done with Lang)
    public function allSpecialities(Request $request)
    {
        try {
            $query = Speciality::query();
            if (request('search')) {
                $query->where(function ($query) {
                    $query->where("name_en", 'like', '%' . request('search') . '%')
                        ->orWhere("name_ar", 'like', '%' . request('search') . '%');
                });
            }

            $speciality = $query->select(
                'id',
                DB::raw("IFNULL(name_{$this->lang}, name_en) as name"),
                'image'
            )->get();
            // $speciality = $speciality->map(function ($special) {
            //     $special->image = url("api/{$special->image}");
            //     return $special;
            // });
            return $this->SuccessResponse(200, 'All specialities reterieved successfully', $speciality);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }
    // API for All Cities (Done with Lang)
    public function allCities(Request $request)
    {
        try {
            $query = Hospital::query();
            if (request('search')) {
                $query->where(function ($query) {
                    $query->where("city", 'like', '%' . request('search') . '%');
                });
            }
            $cities = $query->select('city')->groupBy('city')->get();
            return $this->SuccessResponse(200, 'All Cities reterieved successfully', $cities);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }
    // API for All Insurances (Done with Lang)
    public function get_insurances(Request $request)
    {
        try {
            $query = Insurance::query();
            if (request('city')) {
                $hospitals_ids = Hospital::where('city', 'like', '%' . request('city') . '%')
                    ->pluck('id');
                $query->whereHas('hospitals', function ($query) use ($hospitals_ids) {
                    $query->whereIn('hospital_id', $hospitals_ids);
                });
            }
            if (request('search')) {
                $query->where(function ($query) {
                    $query->where("name_en", 'like', '%' . request('search') . '%')
                        ->orWhere("name_ar", 'like', '%' . request('search') . '%');
                });
            }
            $insurance = $query->select(
                'id',
                DB::raw("IFNULL(name_{$this->lang}, name_en) as name"),
            )->orderBy('id', 'desc')->get();
            return $this->SuccessResponse(200, "All Insurance reterieved successfully", $insurance);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }
    // API for All Doctoes (Done with Out Lang)
    public function DoctorWithFilter(Request $request)
    {
        $token = request()->bearerToken();
        $patient_id = null;
        if ($token) {
            $tokenModel = PersonalAccessToken::findToken($token);
            if ($tokenModel) {
                $patient_id = $tokenModel->tokenable->id; // 'tokenable' refers to the user model
            }
        }
        try {
            $hospital_query = Hospital::query();
            if (request('insurance') && !empty(request('insurance'))) {
                $hospital_query->whereHas('insurances', function ($query) {
                    $query->where('insurance_id', request('insurance'));
                });
            }
            if (request('city')) {
                $hospital_query = $hospital_query->where('city', 'like', '%' . request('city') . '%');
            }
            $hospital_ids = $hospital_query->pluck('id');
            $query = User::query();
            if (request('search')) {
                $query->where(function ($query) {
                    $query->where("name_en", 'like', '%' . request('search') . '%')
                        ->orWhere("name_ar", 'like', '%' . request('search') . '%');
                });
            }
            if (request('speciality') && !empty(request('speciality'))) {
                $query->where(function ($query) {
                    $query->where("speciality_id", request('speciality'));
                });
            }

            // Perform the left join with the reviews table
            $query->leftJoin('reviews', 'users.id', '=', 'reviews.doctor_id')
                ->leftJoin('wishlists', function ($join) use ($patient_id) {
                    $join->on('users.id', '=', 'wishlists.doctor_id')
                        ->where('wishlists.patient_id', '=', $patient_id);
                })
                ->where('user_type', 'D')
                ->whereIn('users.hospital_id', $hospital_ids)
                ->select(
                    'users.id',
                    DB::raw('AVG(reviews.star_rated) as avg_rating'), // Average of ratings
                    DB::raw('COUNT(reviews.id) as reviews_count'), // Count of reviews
                    DB::raw("IFNULL(users.name_{$this->lang}, users.name_en) as name"),
                    'users.profile_image',
                    DB::raw('IF(wishlists.id IS NOT NULL, TRUE, FALSE) as is_favorited'),
                    'users.gender',
                    'users.pricing',
                    'users.hospital_id', // Include hospital_id for the relationship
                    'users.speciality_id', // Include speciality_id for the relationship
                )
                ->with([
                    'hospital' => function ($query) {
                        $query->select([
                            'id',
                            DB::raw("IFNULL(hospital_name_{$this->lang}, hospital_name_en) as hospital_name"),
                        ]);
                    },
                    'speciality' => function ($query) {
                        $query->select([
                            'id',
                            DB::raw("IFNULL(name_{$this->lang}, name_en) as speciality_name")
                        ]);
                    }
                ])
                ->groupBy(
                    'wishlists.id',
                    'users.id',
                    'users.hospital_id',
                    'users.speciality_id',
                    'users.name_en',
                    'users.pricing',
                    'users.gender',
                    'users.name_ar',
                    'users.profile_image'
                ); // Group by user fields

            $doctors = $query->get();
            return $this->SuccessResponse(200, 'Doctor list', $doctors);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }
    /* End Search For Doctors APIs*/

    /* Start Doctor Profile API*/
    public function DoctorProfile($id)
    {
        try {
            $baseUrl = getenv('BASE_URL') . 'images/'; // Replace with your actual base URL
            $profile = User::where('users.id', $id)
                ->join('specialities', 'specialities.id', 'users.speciality_id')
                ->join('hospitals', 'hospitals.id', 'users.hospital_id')
                ->select(
                    'users.id',
                    // 'users.name',
                    DB::raw("IFNULL(users.name_{$this->getLang()}, users.name_en) as name"),
                    'users.profile_image',
                    'users.pricing',
                    // 'specialities.name as speciality_name',
                    DB::raw("IFNULL(specialities.name_{$this->getLang()}, specialities.name_en) as speciality_name"),
                    'users.description',
                    DB::raw("CONCAT('$baseUrl', specialities.image) as speciality_image"), // Concatenate the base URL with the image path
                    DB::raw("IFNULL(hospitals.hospital_name_{$this->getLang()}, hospitals.hospital_name_en) as hospital_name"),
                    // 'hospitals.hospital_name'
                    'hospitals.id as hospital_id'
                )
                ->first();

            $specialization = Specialization::where('user_id', $id)->select('specialization_title')->get();
            $profile['specialization'] = $specialization;
            return $this->SuccessResponse(200, 'Doctor profile', $profile);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }
    /* End Doctor Profile API*/

    // Start Avail Slot API
    public function get_availability(Request $request, $id)
    {
        $doctor = User::find($id);
        $doctor->load("regularAvailabilities", "oneTimeailabilities", "unavailailities");
        // return $doctor;
        $time_interval = 15;
        // Create selected CarbonDate instance
        $selectedDate = CarbonImmutable::parse($request->date);
        // create date
        $date = $selectedDate->format("Y-m-d");
        // day of the week
        $day_name = strtolower($selectedDate->format("l"));

        // Doctor set unavailabilty on a specific date
        $unavailability = $doctor->unavailailities()->where("date", $date)->first();
        // return Not available
        if ($unavailability) {

            return $this->SuccessResponse(200, "Not Available", []);
        }

        // Check if doctor set One time appointment on a specific date
        $availability = null;
        $oneTimeAvailability = $doctor->oneTimeailabilities()->where("date", $date)->first();
        if ($oneTimeAvailability) {
            // Get time intervals to create slots
            $time_interval = $oneTimeAvailability->time_interval ? $oneTimeAvailability->time_interval : 15;
            $availability = $oneTimeAvailability;
        } else {
            $regularAvailability = $doctor->regularAvailabilities()->where("week_day", $day_name)->first();
            if ($regularAvailability) {
                // Get time intervals to create slots
                $time_interval = $regularAvailability->time_interval ? $regularAvailability->time_interval : 15;
                $availability = $regularAvailability;
            }
        }

        // if availability is null
        if (!$availability) {

            return $this->SuccessResponse(200, "Not Available", []);
        }
        // Appointments of selected date
        $appointments = Appointment::where('appointment_date', $date)
            ->where('doctor_id', $doctor->id)->pluck("appointment_time");

        // Creating Slots
        $slots = [];
        $filteredSlots = collect([]);
        $intervals = collect($availability->slots);

        // Fliter slots
        foreach ($intervals as  $interval) {
            $start_dt = $date . $interval["start_time"];
            $end_dt = $date . $interval["end_time"];

            // Create Slots
            $slots = CarbonPeriod::create($start_dt, $availability->time_interval . ' minutes', $end_dt);

            foreach ($slots as $slot) {
                if ($slot->greaterThan(Carbon::now()->addMinutes(20))) {
                    if (!$appointments->contains($slot->format("H:i:s"))) {
                        $filteredSlots->push($slot->format("H:i"));
                    }
                }
            }
        }
        return $this->SuccessResponse(200, 'Available slots', $filteredSlots->unique()->values()->slice(0, -1)->all());
    }
    // End Avail Slot API

    // Start bestsDoctors API
    public function bestsDoctors()
    {
        try {
            $doctors = User::leftJoin('reviews', 'reviews.doctor_id', 'users.id')
                ->join('specialities', 'specialities.id', 'users.speciality_id')
                ->join('hospitals', 'hospitals.id', 'users.hospital_id')
                ->where('users.user_type', '=', 'D')
                ->select('users.id',
                DB::raw("IFNULL(users.name_{$this->getLang()}, users.name_en) as name"),
                // 'users.name',
                // 'users.profile_image', 'specialities.name as speciality_name',
                DB::raw("IFNULL(specialities.name_{$this->getLang()}, specialities.name_en) as speciality_name"),
                'users.description', 'specialities.image as speciality_image',
                DB::raw("IFNULL(hospitals.hospital_name_{$this->getLang()}, hospitals.hospital_name_en) as hospital_name"),
                // 'hospitals.hospital_name'
                'hospitals.id as hospital_id', DB::raw('IFNULL(AVG(reviews.star_rated), 0) as avg_rating'))
                ->groupBy('users.id', 'users.name_ar', 'users.name_en', 'users.profile_image', 'specialities.name_ar',
                'specialities.name_en', 'users.description',
                'specialities.image',
                'hospitals.hospital_name_ar', 'hospitals.hospital_name_en',
                'hospitals.id')
                ->orderBy('avg_rating', 'DESC')

            ->paginate(12);
            return $this->SuccessResponse(200, 'Doctor profiles by specialty', $doctors);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }
    // End bestsDoctors API

    // Start wish List Part
    public function AddToWishlist(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required', 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        $isExist = DB::table('wishlists')->Where('patient_id', '=', $request->user()->id)
            ->where(function ($query) use ($request) {
                $query->where('doctor_id', '=', $request->doctor_id);
            });
        if ($isExist->first() != null) {
            DB::table('wishlists')->where('id', $isExist->first()->id)->delete();

            return $this->SuccessResponse(200, 'Removed from wishlist!', null);
        }
        DB::table('wishlists')->insert(
            [
                'doctor_id' => $request->doctor_id,
                'patient_id' => $request->user()->id
            ]
        );
        return $this->SuccessResponse(200, 'Added to wishlist!', null);
    }

    public function Wishlist(Request $request)
    {

        $baseUrl = getenv('BASE_URL') . 'images/';

        $doctors = Wishlist::join('users', 'users.id', 'wishlists.doctor_id')
            ->join('specialities', 'specialities.id', 'users.speciality_id')
            ->join('hospitals', 'hospitals.id', 'users.hospital_id')
            ->where('wishlists.patient_id', $request->user()->id)
            ->select(
                'users.id',
                // 'users.name',
                DB::raw("IFNULL(users.name_{$this->getLang()}, users.name_en) as name"),
                DB::raw("CONCAT('$baseUrl', users.profile_image) as profile_image"), // Concatenate the base URL with profile_image
                // 'specialities.name as speciality_name',
                DB::raw("IFNULL(specialities.name_{$this->getLang()}, specialities.name_en) as speciality_name"),
                DB::raw("CONCAT('$baseUrl', specialities.image) as speciality_image"), // Concatenate the base URL with speciality_image
                DB::raw("IFNULL(hospitals.hospital_name_{$this->getLang()}, hospitals.hospital_name_en) as hospital_name"),
                    // 'hospitals.hospital_name'
            )
            ->get();
        return $this->SuccessResponse(200, 'wishlist  Data', $doctors);
    }
    // End wish List Part
}
