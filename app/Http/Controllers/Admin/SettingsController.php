<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    protected  $image_path = 'public/images/';
    public function index()
    {
        if(Auth::user()->is_admin()){
            return view('admin.settings.index', [
                'setting' => Settings::first(),
            ]);
        }else{
            abort(401);
        }
    }

    public function store(Settings $settings,Request $request)
    {
        if (($settings = Settings::first()) && Auth::user()->is_admin())
        {
            $attributes = $request->validate([
                'website_name' => 'nullable',
                'phone' => 'nullable',
                'email' => 'nullable',
                'privacy_policy_en' => 'nullable',
                'privacy_policy_ar' => 'nullable',
                'terms_ar' => 'nullable',
                'terms_en' => 'nullable',
                'return_policy_ar' => 'nullable',
                'return_policy_en' => 'nullable',
                'logo' => 'nullable',
                'favicon' => 'nullable',
                'address_line_1' => 'nullable',
                'address_line_2' => 'nullable',
                'city' => 'nullable',
                'state' => 'nullable',
                'zip_code' => 'nullable',
                'country' => 'nullable',
                'facebook' => 'nullable',
                'twitter' => 'nullable',
                'youtube' => 'nullable',
                'linkedin' => 'nullable',
                'instagram' => 'nullable',
                'tax_number' => 'nullable',
                'vat' => 'nullable',
            ]);
            if ($attributes['logo'] ?? false)
            {
                if ($file = $request->file('logo'))
                {
                    $logo = time() . '-' . $file->getClientOriginalName();
                    // Storage::disk('local')->put($this->image_path . $logo , $file->getContent());
                    $file->move(public_path('images'), $logo);

                }
                $attributes['logo'] = $logo;
            }
            if ($attributes['favicon'] ?? false)
            {
                if ($file = $request->file('favicon'))
                {
                    $favicon = time() . '-' . $file->getClientOriginalName();
                    // Storage::disk('local')->put($this->image_path . $favicon, $file->getContent());
                    $file->move(public_path('images'), $favicon);
                }
                $attributes['favicon'] = $favicon;
            }
            $settings->update($attributes);
        }else{
            abort(401);
        }
        return redirect()->back();
    }


}
