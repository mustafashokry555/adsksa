<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{

    public function store(Request $request)
    {
        try {
            $attributes = $request->validate([
                'subject_en' => 'required',
                'subject_ar' => 'required',
                'image' => 'required|image',
                'hospital_id' => 'required',
                'is_active' => 'required|boolean',
                'expired_at' => 'required',
            ]);

            if ($file = $request->file('image')) {
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('images/banners'), $filename);
            }
            $attributes['image'] = $filename;
            $banner = Banner::create($attributes);
            return $banner;
        }catch (\Throwable $th) {
            return $this->ErrorResponse(400, $th->getMessage());
        }
    }
}
