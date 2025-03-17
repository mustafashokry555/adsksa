<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use App\Models\PatientInsurance;
use App\Models\User;
use Illuminate\Http\Request;

class PatientInsuranceController extends Controller
{
    // Show patient insurance details in hospital
    public function show($patient_id, Request $request)
    {
        $patient = User::find($patient_id);
        $insurance_details = PatientInsurance::with(['patient', 'insurance'])
        ->where('patient_id', $patient->id)->first();
        $insurances = Insurance::all();

        return view('hospital.patient.insurance_update', compact('insurance_details', 'patient', 'insurances'));
    }

    // Show patient insurance details in patient
    public function showForPatient( Request $request)
    {
        $patient = auth()->user();
        $insurance_details = PatientInsurance::with(['patient', 'insurance'])
        ->where('patient_id', $patient->id)->first();
        $insurances = Insurance::all();

        return view('patient.insurance_details', compact('insurance_details', 'patient', 'insurances'));
    }

    // Update patient insurance details
    public function update($patient_id, Request $request)
    {
        $request->validate([
            'insurance_id' => 'required|exists:insurances,id',
            'medical_network' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'co_payment_percentage' => 'required|numeric|min:0',
            'submission_date' => 'required|date',
            'subscriber_type' => 'required|string|max:255',
            'insurance_policy_number' => 'required|string|max:255',
            'coverage_limits' => 'required|string|max:255',
            'insurance_expiry_date' => 'required|date|after_or_equal:submission_date',
            'subscriber_number' => 'required|string|max:255',
        ]);
        $patient = User::findOrFail($patient_id);

        $insuranceDetails = PatientInsurance::updateOrCreate(
            ['patient_id' => $patient->id],
            [
                'insurance_id' => $request->insurance_id,
                'medical_network' => $request->medical_network,
                'category' => $request->category,
                'co_payment_percentage' => $request->co_payment_percentage,
                'submission_date' => $request->submission_date,
                'subscriber_type' => $request->subscriber_type,
                'insurance_policy_number' => $request->insurance_policy_number,
                'coverage_limits' => $request->coverage_limits,
                'insurance_expiry_date' => $request->insurance_expiry_date,
                'subscriber_number' => $request->subscriber_number,
            ]
        );
        return redirect()
        ->back()
        ->with('flash', ['type', 'success', 'message' => 'Insurance Details Updated Successfuly']);    }
}
