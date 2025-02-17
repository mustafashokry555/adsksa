<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PatientDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Auth;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    protected $lang;

    public function __construct(Request $request)
    {
        $this->lang = $request->header('lang', 'en');
    }
    // Done
    public function login(Request $request)
    {
        try {
            $data = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return $this->ErrorResponse(404, trans('auth.email'), null);
            }
            if (!Hash::check($request->password, $user->password)) {
                return $this->ErrorResponse(401, trans('auth.password_incorrect'));
            }
            $user->status = 'Active';
            $user->save();
            $token = $user->createToken('MyApp')->plainTextToken;
            return $this->SuccessResponse(200, trans('auth.loginGood'), $token);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->ErrorResponse(422, $th->getMessage());
        }
    }
    // Done
    public function PatientProfile(Request $request)
    {
        $patient = Auth::user();
        $lang = $request->header('lang', 'en');
        if ($patient) {
            $patient = User::with(['patientDetails', 'appSetting'])->find($patient->id);
            if( $lang == 'ar' && (!empty($patient->name_ar) || $patient->name_ar != null)){
                $patient->name = $patient->name_ar;
            }else{
                $patient->name = $patient->name_en;
            }
        }
        return $this->SuccessResponse(200, 'Patient profile!', $patient);
    }
    // Done
    public function register(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name_en' => ['required', 'string', 'max:255'],
                // 'name_ar' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'min:6'],
                'mobile' => 'required|numeric|digits:9',//unique:users,mobile
                'date_of_birth' => 'nullable|date|before:today',
                'gender' => 'nullable|string|in:male,female',
                'height' => 'nullable|numeric|min:30|max:300',
                'weight' => 'nullable|numeric|min:1|max:500',
                'diabetes' => 'nullable|boolean',
                'pressure' => 'nullable|boolean',
                'disability' => 'nullable|boolean',
                'medical_history' => 'nullable|boolean',
                'address' => 'nullable|string|max:255',
                // 'otp'=>    'required|integer',
                // 'country_code' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // $sid = getenv("TWILIO_ACCOUNT_SID");
            // $token = getenv("TWILIO_AUTH_TOKEN");
            // $service_sid = getenv("VERIFY_SERVICE_SID");

            // $twilio = new Client($sid, $token);
            // DB::beginTransaction();
            $user = User::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'mobile'  => $request->mobile,
                'user_type'  => 'U',
                'date_of_birth' => $request->date_of_birth,
                'country' => $request->country,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'code'  => 'Mobile App',//we need to add this to migration
            ]);
            // create patient detials
            $patientDetail = PatientDetail::create([
                'height' => $request->height,
                'weight' => $request->weight,
                'disease' => json_encode([
                    'diabetes' => $request->diabetes ?? '0',
                    'pressure' => $request->pressure ?? '0',
                    'disability' => $request->disability ?? '0',
                    'medical_history' => $request->medical_history ?? '0',
                ]),
                'user_id' => $user->id,
            ]);
            // if ($user->details) {
            //     DB::commit();
            // } else {
            //     DB::rollback();
            // }
            // $verification = $twilio->verify->v2->services($service_sid)
            //     ->verifications
            //     ->create($request->country_code . $request->mobile, "sms");
            return $this->SuccessResponse(200, trans('auth.logupGood'), NULL);
        } catch (\Throwable $th) {
            // DB::rollback();
            //throw $th;
            return $this->ErrorResponse(422, $th->getMessage());
        }
    }

    public function LoginWithNumber(Request $request)
    {

        try {
            $data = $request->validate([
                'mobile' => 'required',
                'country_code' => 'required',
            ]);
            // $fakeEmail = 'guest' . Faker::create()->unique()->randomNumber(3) . '@yopmail.com';
            $user = User::where('mobile', $request->mobile)->first();
            if (!$user) {
                return $this->SuccessResponse(404, 'you are not registered with the given mobile number', null);
            }
            return $this->SuccessResponse(200, 'Otp sent on your number , please check and verify', null);

            // $insert= User::UpdateOrCreate(['mobile'=>$request->mobile],['name'=>'user','email'=>$fakeEmail ,'user_type'=>User::PATIENT,'status'=>'Inactive']);
            // if ($user) {
            //     $sid = getenv("TWILIO_ACCOUNT_SID");
            //     $token = getenv("TWILIO_AUTH_TOKEN");
            //     $service_sid = getenv("VERIFY_SERVICE_SID");

            //     $twilio = new Client($sid, $token);

            //     $verification = $twilio->verify->v2->services($service_sid)
            //         ->verifications
            //         ->create($data['country_code'] . $data['mobile'], "sms");

            //     return $this->SuccessResponse(200, 'Otp sent on your number , please check and verify', null);
            // } else {
            //     return $this->ErrorResponse(400, 'Something Went wrong!');
            // }
        } catch (\Throwable $th) {
            //throw $th;
            return $this->ErrorResponse(422, $th->getMessage());
        }
    }

    public function VerifyOtp(Request $request)
    {
        try {

            $data = $request->validate([
                'mobile' => 'required',
                'otp' => 'required',
                'country_code' => 'required',
            ]);
            $user = User::where('mobile', $request->mobile)->first();
            if (!$user) {
                return $this->SuccessResponse(404, 'you are not registered with the given mobile number', null);
            }
            // $sid = getenv("TWILIO_ACCOUNT_SID");
            // $token = getenv("TWILIO_AUTH_TOKEN");
            // $service_sid = getenv("VERIFY_SERVICE_SID");

            // $twilio = new Client($sid, $token);

            // $verification_check = $twilio->verify->v2->services($service_sid)
            //     ->verificationChecks
            //     ->create(
            //         [
            //             "to" => $data['country_code'] . $data['mobile'],
            //             "code" => $data['otp']
            //         ]
            //     );

            // if ($verification_check->valid) {
            $user = User::where('mobile', $data['mobile'])->update(['status' => 'Active']);
            $user = User::where('mobile', $data['mobile'])->first();
            $user['token'] = $user->createToken('MyApp')->plainTextToken;
            return $this->SuccessResponse(200, 'Mobile number verified', $user);
            // } else {
            //     return $this->ErrorResponse(400, 'Invalid verification code entered!');
            // }
        } catch (\Throwable $th) {
            //throw $th;
            return $this->ErrorResponse(422, $th->getMessage());
        }
    }


    // Done
    public function UpdatePatientProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_en' => ['required', 'string', 'max:255'],
            // 'name_ar' => ['required', 'string', 'max:255'],
            'profile_image' => 'nullable|file|mimes:jpeg,png,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $patient = User::find($request->user()->id);

            if ($request->profile_image) {
                $image = $request->profile_image;
                $publicPath = public_path("images/");
                $filename = time() . '_' . preg_replace('/\s+/', '_', $image->getClientOriginalName());
                $image->move($publicPath, $filename);
                $patient->profile_image = $filename;
                $patient->save();
            }

            $patient->name_en = $request->name_en;
            $patient->name_ar = $request->name_ar;
            $patient->address = $request->address;
            $patient->email = $request->email ?? $patient->email;
            $patient->country = $request->country;
            $patient->state = $request->state;
            $patient->zip_code = $request->zip_code;
            $patient->date_of_birth = $request->date_of_birth;
            $patient->gender = $request->gender;
            $patient->age = $request->age;
            $patient->blood_group = $request->blood_group;
            $patient->mobile = $request->mobile;
            $patient->last_name = $request->last_name;
            $patient->marital_status = $request->marital_status;
            $patient->emergency_contact_name = $request->emergency_contact_name;
            $patient->emergency_contact_number = $request->emergency_contact_number;
            $patient->nationality = $request->nationality;
            $patient->address_line_1 = $request->address_line_1;
            $patient->address_line_2 = $request->address_line_2;
            $patient->save();

            return $this->SuccessResponse(200, 'Profile upadated successfully!', $patient);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(422, $th->getMessage());
        }
    }

    // Done
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        $user = Auth::user();
        $patient = User::find($user->id);

        if (!Hash::check($request->old_password, $patient->password)) {
            return $this->ErrorResponse(400, trans('auth.password_incorrect'));
        }

        $patient->password = Hash::make($request->password);
        $patient->save();

        return $this->SuccessResponse(200, trans('auth.password_change'), $patient);
    }

}
