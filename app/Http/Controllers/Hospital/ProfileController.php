<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    protected  $image_path = 'public/images/hospitals/';
    public function editProfile()
    {
        return view('hospital.profile.edit', [
            'hospital_admin' => Auth::user(),
        ]);
    }
    public function updateProfile(Request $request)
    {
        // exit;
        dd("djfhjkdh");

        $hospital = Auth::user();
        $attributes = $request->validate([
            'name' => ['required'],
            'email' => [
                'required',
                Rule::unique('users', 'email')->ignore($hospital->id)
            ],
            'username' => ['nullable'],
            'mobile' => ['nullable'],
            'profile_image' => ['image'],
            'address' => ['nullable'],
            'country' => ['required'],
            'state' => ['required'],
            'zip_code' => ['required'],
            'description' => ['nullable'],
        ]);
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = $user->profile_image ?? time() . '-' . $file->getClientOriginalName();
            Storage::disk('local')->put($this->image_path . $filename, $file->getContent());
            $attributes['profile_image'] = $filename;
        }
        // dd($user);
        Auth::user()->update($attributes);

        return redirect()->back()->with('flash', ['type', 'success', 'message' => 'Profile Updated Successfully']);
    }

    public function editPassword()
    {
        return view('hospital.profile.change-password');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);
        //  dd($request->all());

        auth()->user()->update(['password' => \Hash::make($request->password)]);

        return redirect()
            ->back()
            ->with('flash', ['type', 'success', 'message' => 'Password Changed Successfully']);
    }
}
