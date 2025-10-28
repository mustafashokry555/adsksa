<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\ContactUs;

class PrivacyAndTermsConditionController extends Controller
{
    public function privacy(){
        return view('privacy-policy.privacy-policy');
    }

    public function termsAndconditions(){
        return view('privacy-policy.terms-and-conditions');
    }

    public function contactus(Request $request){
        ContactUs::create($request->all());
        return redirect()->back()->with('flash', ['type', 'success', 'message' => 'Your information send successfully!']);
    }
}
