<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfferType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferTypesController extends Controller
{
    protected $image_path = 'public/images/';
    public function index(Request $request)
    {
        if (Auth::user()->is_admin()) {
            $offer_types = OfferType::all();
            return view('admin.offer_types.index', [
                'offer_types' => $offer_types,
            ]);
        } else {
            abort(401);
        }
    }

    public function create()
    {
        if (Auth::user()->is_admin()) {
            return view('admin.offer_types.create');
        }else {
            abort(401);
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->is_admin()) {

            $attributes = $request->validate([
                'name_en' => 'required',
                'name_ar' => 'required',
                'status' => 'required|in:0,1',
                'image' => 'required|image',
            ]);
            if ($file = $request->file('image')) {
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('images/offer_types'), $filename);
                $attributes['image'] = $filename;
            }
            OfferType::create($attributes);
            return redirect()
                ->route('offer-types.index')
                ->with('flash', ['type', 'success', 'message' => 'Offer Types Added Successfully.']);
        }else{
            abort(401);
        }
    }


    public function edit($id)
    {
        if (Auth::user()->is_admin()) {
            return view('admin.offer_types.edit', [
                'offer_type' => OfferType::find($id),
            ]);
        }else {
            abort(401);
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->is_admin()) {

            if ($offer_type = OfferType::find($id)) {
                $attributes = $request->validate([
                    'name_ar' => 'required',
                    'name_en' => 'required',
                    'status' => 'required|in:0,1',
                    'image' => 'nullable|image',
                ]);
                if ($request->hasFile('image')) {
                    if ($file = $request->file('image')) {
                        $filename = time() . '-' . $file->getClientOriginalName();
                        $file->move(public_path('images/offer_types'), $filename);
                    }
                    $attributes['image'] = $filename;
                }
                $offer_type->update($attributes);

                return redirect()
                    ->route('offer-types.index')
                    ->with('flash', ['type', 'success', 'message' => 'Offer Type Updated Successfully.']);
            }
        }else{
            abort(401);
        }
    }

    public function destroy($id)
    {
        if(Auth::user()->is_admin()){

            $offer_type = OfferType::find($id);
            $offer_type->delete();
            
            return redirect()
            ->route('offer-types.index')
            ->with('flash', ['type', 'success', 'message' => 'Offer Type Deleted Successfuly']);
        }else{
            abort(401);
        }
    }

    public function toggleActive(Request $request, $id)
    {
        $offer_type = OfferType::findOrFail($id);
        $offer_type->status = $request->status;
        $offer_type->save();

        return response()->json(['message' => 'Status updated successfully']);
    }
}
