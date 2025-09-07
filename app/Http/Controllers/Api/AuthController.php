<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PatientDetail;
use App\Models\User;
use App\Notifications\SendOtpEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
            $user = User::where('email', $request->email)->where('status', 'Active')->first();
            if (!$user) {
                return $this->ErrorResponse(404, trans('auth.email'), null);
            }
            if (!Hash::check($request->password, $user->password)) {
                return $this->ErrorResponse(401, trans('auth.password_incorrect'));
            }
            // $user->status = 'Active';
            // $user->save();
            $token = $user->createToken('MyApp')->plainTextToken;
            return $this->SuccessResponse(200, trans('auth.loginGood'), $token);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->ErrorResponse(422, $th->getMessage());
        }
    }

    // Done
    public function profile_image(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_image' => 'required|image|mimes:jpeg,png,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        try {
            $patient = User::find($request->user()->id);
            $image = $request->profile_image;
            $publicPath = public_path("images/");
            $filename = time() . '_' . preg_replace('/\s+/', '_', $image->getClientOriginalName());
            $image->move($publicPath, $filename);
            $patient->profile_image = $filename;
            $patient->save();

            return $this->SuccessResponse(200, 'Profile upadated successfully!', $patient);
        } catch (\Throwable $th) {
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
            $patient->religion_id = $patient->religion_id ? (int)$patient->religion_id : null;
            if ($patient->patientDetails){
                $patient->patientDetails->user_id = $patient->patientDetails->user_id ? (int)$patient->patientDetails->user_id : $patient->patientDetails->user_id;
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
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'min:6'],
                'mobile' => 'required|numeric|digits:9',
                'date_of_birth' => 'nullable|date|before:today',
                'gender' => 'nullable|string|in:male,female',
                'height' => 'nullable|numeric|min:30|max:300',
                'weight' => 'nullable|numeric|min:1|max:500',
                'diabetes' => 'nullable|boolean',
                'pressure' => 'nullable|boolean',
                'disability' => 'nullable|boolean',
                'medical_history' => 'nullable|boolean',
                'address' => 'nullable|string|max:255',
                'id_number' => ['required', 'string', 'max:50', 'unique:users'],
                'religion_id' => ['required', 'exists:religions,id'],
                'marital_status' => ['nullable', 'string', 'in:single,married,divorced,widowed'],
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
                'code'  => 'Mobile App',
                'id_number' => $request->id_number,
                'religion_id' => $request->religion_id,
                'marital_status' => $request->marital_status,
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
            'name' => ['required', 'string', 'max:255'],
            'gender' => 'nullable|string|in:male,female',
            'date_of_birth' => 'nullable|date|before:today',
            'id_number' => [
                'required',
                'numeric',
                'digits:10',
                Rule::unique('users')->ignore($request->user()->id)
            ],
            'religion_id' => ['required', 'exists:religions,id'],
            'mobile' => 'required|numeric|digits:9',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($request->user()->id)],
            'marital_status' => ['required', 'string', 'in:single,married,divorced,widowed'],
            // 'password' => ['nullable', 'min:6'],
            // 'height' => 'nullable|numeric|min:30|max:300',
            // 'weight' => 'nullable|numeric|min:1|max:500',
            // 'diabetes' => 'nullable|boolean',
            // 'pressure' => 'nullable|boolean',
            // 'disability' => 'nullable|boolean',
            // 'medical_history' => 'nullable|boolean',
            // 'address' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $patient = User::find($request->user()->id);

            // if ($request->profile_image) {
            //     $image = $request->profile_image;
            //     $publicPath = public_path("images/");
            //     $filename = time() . '_' . preg_replace('/\s+/', '_', $image->getClientOriginalName());
            //     $image->move($publicPath, $filename);
            //     $patient->profile_image = $filename;
            //     $patient->save();
            // }

            $patient->name_en = $request->name;
            $patient->name_ar = $request->name;
            $patient->gender = $request->gender;
            $patient->date_of_birth = Carbon::parse($request->date_of_birth)->format('Y-m-d');
            $patient->id_number = $request->id_number;
            $patient->religion_id = $request->religion_id;
            $patient->email = $request->email;
            $patient->mobile = $request->mobile;
            $patient->marital_status = $request->marital_status;
            // $patient->address = $request->address;
            // $patient->country = $request->country;
            // $patient->state = $request->state;
            // $patient->zip_code = $request->zip_code;
            // $patient->age = $request->age;
            // $patient->blood_group = $request->blood_group;
            // $patient->last_name = $request->last_name;
            // $patient->emergency_contact_name = $request->emergency_contact_name;
            // $patient->emergency_contact_number = $request->emergency_contact_number;
            // $patient->address_line_1 = $request->address_line_1;
            // $patient->address_line_2 = $request->address_line_2;
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


    // Eamil Reset Pass
    public function sendResetEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'No account found with this email address.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        // Generate OTP
        $otp = rand(100000, 999999);

        // Store OTP in password_resets table
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $otp,
                'created_at' => Carbon::now()
            ]
        );

        // Send OTP via email
        $user->notify(new SendOtpEmail($otp));

        return response()->json([
            'success' => true,
            'message' => 'We have emailed your password reset OTP!',
            'data' => [
                'email' => $request->email
            ]
        ]);
    }

    public function verifyOtp2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric|digits:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $passwordReset = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->otp)
            ->first();

        if (!$passwordReset) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP.',
            ], 400);
        }

        // Check if OTP is expired (5 minutes)
        $createdAt = Carbon::parse($passwordReset->created_at);
        if (Carbon::now()->diffInMinutes($createdAt) > 5) {
            return response()->json([
                'success' => false,
                'message' => 'OTP has expired. Please request a new one.',
            ], 400);
        }

        // Generate a reset token
        $token = \Illuminate\Support\Str::random(60);
        DB::table('password_resets')->where('email', $request->email)->update([
            'token' => $token
        ]);

        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully.',
            'data' => [
                'email' => $request->email,
                'token' => $token
            ]
        ]);
    }
    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Verify token
        $passwordReset = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$passwordReset) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid token.',
            ], 400);
        }

        // Update user password
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->setRememberToken(Str::random(60));
        $user->save();

        // Delete the token
        DB::table('password_resets')->where('email', $request->email)->delete();

        // Fire password reset event
        event(new PasswordReset($user));

        return response()->json([
            'success' => true,
            'message' => 'Your password has been reset successfully!',
        ]);
    }

    public function delete_account(Request $request){
        try {
            // $validator = Validator::make($request->all(), [
            //     'password' => 'required|string',
            // ]);
            // if ($validator->fails()) {
            //     return response()->json([
            //         'message' => 'Validation failed',
            //         'errors' => $validator->errors()
            //     ], 422);
            // }
            // Check if the provided password matches the user's password
            // if (!Hash::check($request->password, Auth::user()->password)) {
            //     return $this->ErrorResponse(422, "The provided password is incorrect.");
            // }
            // Get the authenticated user
            $user = Auth::user();

            // Revoke all tokens if using Laravel Sanctum
            if (method_exists($user, 'tokens')) {
                $user->tokens()->delete();
            }
            // Perform any cleanup needed before deletion
            $user->status = 'Inactive';
            $user->save();
            return $this->SuccessResponse(200, 'Account successfully deleted', NULL);
        } catch (\Throwable $th) {
            return $this->ErrorResponse(422, $th->getMessage());
        }
    }

}
