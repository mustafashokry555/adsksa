<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurrencyController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->is_admin()) {
            $currancies = Currency::withTrashed()->get();
            return view('admin.currency.index', [
                'currancies' => $currancies,
            ]);
        } else {
            abort(401);
        }
    }

    public function create()
    {
        if (Auth::user()->is_admin()) {
            return view('admin.currency.create');
        } else {
            abort(401);
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->is_admin()) {

            $attributes = $request->validate([
                'name_en' => 'required',
                'name_ar' => 'required',
                'code_ar' => 'required',
                'code_en' => 'required',
                'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if ($attributes['icon'] ?? false) {
                if ($file = $request->file('icon')) {
                    $filename = time() . '-' . $file->getClientOriginalName();
                    // Storage::disk('local')->put($this->image_path . $filename, $file->getContent());
                    $file->move(public_path('images/currency'), $filename);
                }
                $attributes['icon'] = $filename;
            }
            Currency::create($attributes);
            return redirect()
                ->route('currency.index')
                ->with('flash', ['type', 'success', 'message' => 'currency Added Successfully.']);
        } else {
            abort(401);
        }
    }


    public function edit($id)
    {
        if (Auth::user()->is_admin()) {
            return view('admin.currency.edit', [
                'currency' => Currency::find($id),
            ]);
        } else {
            abort(401);
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->is_admin()) {

            if ($currency = Currency::find($id)) {
                $attributes = $request->validate([
                    'name_ar' => 'required',
                    'name_en' => 'required',
                    'code_ar' => 'required',
                    'code_en' => 'required',
                    'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                if ($attributes['icon'] ?? false) {
                    if ($file = $request->file('icon')) {
                        $filename = time() . '-' . $file->getClientOriginalName();
                        // Storage::disk('local')->put($this->image_path . $filename, $file->getContent());
                        $file->move(public_path('images/currency'), $filename);
                    }
                    $attributes['icon'] = $filename;
                }
                $currency->update($attributes);

                return redirect()
                    ->route('currency.index')
                    ->with('flash', ['type', 'success', 'message' => 'Currency Updated Successfully.']);
            }
        } else {
            abort(401);
        }
    }

    public function destroy($id)
    {
        if (Auth::user()->is_admin()) {

            $currency = Currency::find($id);
            $currency->delete();

            return redirect()
                ->route('currency.index')
                ->with('flash', ['type', 'success', 'message' => 'Currency Deleted Successfuly']);
        } else {
            abort(401);
        }
    }
    public function restore($id)
    {
        Currency::onlyTrashed()->find($id)->restore();

        return redirect()->route('currency.index')
            ->with('flash', ['type', 'success', 'message' => 'Currency restored successfully.']);
    }

    public function forceDelete($id)
    {
        Currency::onlyTrashed()->find($id)->forceDelete();

        return redirect()->route('currency.index')
            ->with('flash', ['type', 'success', 'message' => 'Currency permanently deleted.']);
    }
}
