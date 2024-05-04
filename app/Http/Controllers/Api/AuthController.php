<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Auth;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
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

    public function PatientProfile(Request $request)
    {
        $patient = User::where('id', $request->user()->id)->select('name', 'profile_image', 'address', 'email', 'country', 'state', 'zip_code', 'date_of_birth', 'gender', 'age', 'blood_group', 'mobile', 'last_name', 'marital_status', 'emergency_contact_name', 'emergency_contact_number', 'nationality', 'address_line_1', 'address_line_2')->first();
        return $this->SuccessResponse(200, 'Patient profile!', $patient);
    }

    public function UpdatePatientProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'profile_image' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            if ($request->hasFile('profile_image')) {

                $file = $request->file('profile_image');
                $imageName = time() . '.' . $file->extension();
                $request->profile_image->move(public_path('images'), $imageName);
            }

            $patient = User::find($request->user()->id);
            $patient->name = $request->name;
            $patient->profile_image = $imageName ?? explode(env('BASE_URL'), $patient->profile_image)[1];
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
    public function register(Request $request)
    {

       

        try {

            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'min:8', 'confirmed'],
                'mobile' => 'required|string|min:10|max:12|unique:users,mobile,',
                // 'otp'=>    'required|integer',
                'country_code'=>'required'
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
    
            
           
            $sid = getenv("TWILIO_ACCOUNT_SID");
            $token = getenv("TWILIO_AUTH_TOKEN");
            $service_sid = getenv("VERIFY_SERVICE_SID");

            $twilio = new Client($sid, $token);

          

        

            
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'mobile'  => $request->mobile,
                ]);

                $verification = $twilio->verify->v2->services($service_sid)
                ->verifications
                ->create($request->country_code . $request->mobile, "sms");
                return $this->SuccessResponse(200, 'Mobile number verified', $user);
          
        } catch (\Throwable $th) {
            //throw $th;
            return $this->ErrorResponse(422, $th->getMessage());
        }
        return response()->json(['message' => 'Registration successful'], 201);
    }
}
