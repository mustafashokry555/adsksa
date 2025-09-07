<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        if (auth()->user()->user_type == User::ADMIN) {
            $offers = Offer::whereHas('hospital', function ($q) {
                $q->where('is_active', 1);
            })->with(['hospital'])->get();
            return view('admin.offer.index', compact('offers'));
        }elseif( auth()->user()->user_type == User::HOSPITAL ) {
            $offers = Offer::where('hospital_id', auth()->user()->hospital_id)->with(['hospital'])->get();
            return view('hospital.offer.index', compact('offers'));
        }
    }

    public function create()
    {
        // check if the auth is admin or a hospital
        if( auth()->user()->user_type == User::ADMIN ) {
            $hospitals = Hospital::all();
            return view('admin.offer.create', compact('hospitals'));
        }elseif( auth()->user()->user_type == User::HOSPITAL ) {
            return view('hospital.offer.create');
        }
    }

    public function store(Request $request)
    {
        if( auth()->user()->user_type == User::ADMIN ) {
            $attributes = $request->validate([
                'title_ar' => ['required', 'string', 'max:255'],
                'title_en' => ['required', 'string', 'max:255'],
                'content_ar' => ['required', 'string'],
                'content_en' => ['required', 'string'],
                'hospital_id' => ['required', 'exists:hospitals,id'],
                'type' => ['required', 'in:image,video'],
                'video_link' => ['nullable', 'required_if:type,video', 'url'],
                'images' => ['required'],
                'images.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:4096'],
                'start_date' => ['required', 'date', 'date_format:Y-m-d'],
                'end_date' => [
                    'required',
                    'date',
                    'date_format:Y-m-d',
                    'after_or_equal:start_date'
                ],
            ]);
        }elseif( auth()->user()->user_type == User::HOSPITAL ) {
            $attributes = $request->validate([
                'title_ar' => ['required', 'string', 'max:255'],
                'title_en' => ['required', 'string', 'max:255'],
                'content_ar' => ['required', 'string'],
                'content_en' => ['required', 'string'],
                'type' => ['required', 'in:image,video'],
                'video_link' => ['nullable', 'required_if:type,video', 'url'],
                'images' => ['required'],
                'images.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:4096']
            ]);
            $attributes['hospital_id'] = auth()->user()->hospital_id;
        }

        if ($request->hasFile('images') ) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $filename = time() . '-' . $image->getClientOriginalName();
                $filename = preg_replace('/\s+/', '-', $filename);
                $image->move(public_path('images'), $filename);
                $images[] = $filename;
            }
            $attributes['images'] = json_encode($images);
        }
        $offer = Offer::create($attributes);
        return redirect()->route('offers.index')
            ->with('flash', ['type' => 'success', 'message' => 'Offer created Successfully']);
    }

    public function edit(Offer $offer)
    {
        // check if the auth is admin or a hospital
        if( auth()->user()->user_type == User::ADMIN ) {
            $hospitals = Hospital::all();
            return view('admin.offer.edit', compact('offer', 'hospitals'));
        }elseif( auth()->user()->user_type == User::HOSPITAL ) {
            return view('hospital.offer.edit', compact('offer'));
        }
    }

    public function update(Request $request, $id)
    {
        $offer = Offer::find($id);
        $currentImages = json_decode($offer->getRawOriginal('images'), true) ?? [];

        // Calculate how many images would remain after deletion
        $remainingImagesCount = count($currentImages);
        if ($request->deletedImages) {
            $deletedKeys = explode(',', rtrim($request->deletedImages, ','));
            $remainingImagesCount -= count($deletedKeys);
        }
        // Base validation rules
        $baseRules = [
            'title_ar' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'content_ar' => ['required', 'string'],
            'content_en' => ['required', 'string'],
            'type' => ['required', 'in:image,video'],
            'video_link' => ['nullable', 'required_if:type,video', 'url'],
            'start_date' => ['required', 'date', 'date_format:Y-m-d'],
            'end_date' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'after_or_equal:start_date'
            ],
        ];

        // Image validation rules
        $imageRules = [
            'images' => [
                // Images are required only if there would be no images left after deletion
                $remainingImagesCount <= 0 ? 'required' : 'nullable',
                'array'
            ],
            'images.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:4096']
        ];

        if (auth()->user()->user_type == User::ADMIN) {
            $attributes = $request->validate(array_merge($baseRules, $imageRules, [
                'hospital_id' => ['required', 'exists:hospitals,id'],
                'is_active' => ['boolean'],
            ]));
        } elseif (auth()->user()->user_type == User::HOSPITAL) {
            $attributes = $request->validate(array_merge($baseRules, $imageRules));
            $attributes['hospital_id'] = auth()->user()->hospital_id;
        }

        $newImages = $currentImages;

        // Handle image deletion
        if ($request->deletedImages) {
            $deletedKeys = explode(',', rtrim($request->deletedImages, ','));
            $deletedKeys = array_map(function($url) {
                return basename($url);
            }, $deletedKeys);
            foreach ($deletedKeys as $key) {
                $newImages = array_values(array_diff($newImages, [$key]));
                $imageToDelete = $key;
                $imagePath = public_path('images/' . $imageToDelete);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $newImages = array_values($newImages); // Re-index the array
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '-' . $file->getClientOriginalName();
                $filename = preg_replace('/\s+/', '-', $filename);
                $file->move(public_path('images'), $filename);
                $newImages[] = $filename;
            }
        }

        $attributes['images'] = $newImages;
        $offer->update($attributes);

        return redirect()->route('offers.index')
            ->with('flash', ['type' => 'success', 'message' => 'Offer Updated Successfully']);
    }

    public function destroy($id)
    {
        $offer = Offer::find($id);
        $offer->delete();

        return redirect()->route('offers.index')
        ->with('flash', ['type', 'success', 'message' => 'Offer Deleted Successfully']);
    }
}
