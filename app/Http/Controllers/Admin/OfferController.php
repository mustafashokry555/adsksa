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
        if( auth()->user()->user_type == User::ADMIN ) {
            $offers = Offer::with(['hospital'])->get();
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
                'images.*' => ['required_if:type,image', 'image', 'mimes:jpeg,png,jpg,gif', 'max:4096']
            ]);
        }elseif( auth()->user()->user_type == User::HOSPITAL ) {
            $attributes = $request->validate([
                'title_ar' => ['required', 'string', 'max:255'],
                'title_en' => ['required', 'string', 'max:255'],
                'content_ar' => ['required', 'string'],
                'content_en' => ['required', 'string'],
                'type' => ['required', 'in:image,video'],
                'video_link' => ['nullable', 'required_if:type,video', 'url'],
                'images.*' => ['required_if:type,image', 'image', 'mimes:jpeg,png,jpg,gif', 'max:4096']
            ]);
            $attributes['hospital_id'] = auth()->user()->hospital_id;
        }

        if ($request->hasFile('images') && $request->type === 'image') {
            $images = [];
            foreach ($request->file('images') as $image) {
                $filename = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('images'), $filename);
                $images[] = $filename;
            }
            $attributes['images'] = json_encode($images);
        }
        $offer = Offer::create($attributes);
        return redirect()->route('offers.index')
            ->with('flash', ['type', 'success', 'message' => 'Offer created Successfully']);
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
        if( auth()->user()->user_type == User::ADMIN ) {
            $attributes = $request->validate([
                'title_ar' => ['required', 'string', 'max:255'],
                'title_en' => ['required', 'string', 'max:255'],
                'content_ar' => ['required', 'string'],
                'content_en' => ['required', 'string'],
                'hospital_id' => ['required', 'exists:hospitals,id'],
                'type' => ['required', 'in:image,video'],
                'video_link' => ['nullable', 'required_if:type,video', 'url'],
                'is_active' => ['boolean'],
                'images.*' => ['required_if:type,image', 'image', 'mimes:jpeg,png,jpg,gif', 'max:4096']
            ]);
        }elseif( auth()->user()->user_type == User::HOSPITAL ) {
            $attributes = $request->validate([
                'title_ar' => ['required', 'string', 'max:255'],
                'title_en' => ['required', 'string', 'max:255'],
                'content_ar' => ['required', 'string'],
                'content_en' => ['required', 'string'],
                'type' => ['required', 'in:image,video'],
                'video_link' => ['nullable', 'required_if:type,video', 'url'],
                'images.*' => ['required_if:type,image', 'image', 'mimes:jpeg,png,jpg,gif', 'max:4096']
            ]);
            $attributes['hospital_id'] = auth()->user()->hospital_id;
        }

        // Handle image deletion
        if ($request->deletedImages) {
            $deletedKeys = explode(',', rtrim($request->deletedImages, ','));
            $images = $offer->images;
            foreach ($deletedKeys as $key) {
                $images = array_values(array_diff($images, [$key]));
                $imageToDelete = $key;
                $imagePath = public_path('images/' . $imageToDelete);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $offer->images = array_values($images); // Re-index the array
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $newImages = [];
            $existingImages = $offer->images ?? [];
            foreach ($request->file('images') as $file) {
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);
                $newImages[] = $filename;
            }
            $allImages = array_merge($existingImages, $newImages);
            $offer->images = $allImages;
            $attributes['images'] = $offer->images;
        }
        $offer->update($attributes);

        return redirect()->route('offers.index')
        ->with('flash', ['type', 'success', 'message' => 'Offer Updated Successfully']);
    }

    public function destroy($id)
    {
        $offer = Offer::find($id);
        $offer->delete();

        return redirect()->route('offers.index')
        ->with('flash', ['type', 'success', 'message' => 'Offer Deleted Successfully']);
    }
}
