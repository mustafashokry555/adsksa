<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PatientInsuranceResource;
use App\Models\PatientInsurance;
use Illuminate\Http\Request;

class PatientInsuranceController extends Controller
{
    
    // Show patient insurance details
    public function show(Request $request)
    {
        $insurance = PatientInsurance::with(['patient', 'insurance'])
        ->where('patient_id', $request->user()->id)->first();

        if (!$insurance) {
            return $this->ErrorResponse(404, 'Patient Insurance not found');
        }
        $insurance = PatientInsuranceResource::make($insurance);
        return $this->SuccessResponse(200, "Insurance Details.", $insurance);
    }

    // Update patient insurance details
    public function update(Request $request)
    {
        $request->validate([
            'insurance_id' => 'required|exists:insurances,id',
            'medical_network' => 'required|string',
            'category' => 'required|string',
            'co_payment_percentage' => 'required|numeric',
            'submission_date' => 'required|date',
            'subscriber_type' => 'required|string',
            'insurance_policy_number' => 'required|string',
            'coverage_limits' => 'required|string',
            'insurance_expiry_date' => 'required|date',
            'subscriber_number' => 'required|string',
        ]);
        $insurance = PatientInsurance::where('patient_id', $request->user()->id)->first();;

        if ($insurance) {
            // Update existing record
            $insurance->update($request->only([
                'insurance_id',
                'medical_network',
                'category',
                'co_payment_percentage',
                'submission_date',
                'subscriber_type',
                'insurance_policy_number',
                'coverage_limits',
                'insurance_expiry_date',
                'subscriber_number',
            ]));
    
            return $this->SuccessResponse(200, "Patient Insurance updated successfully", $insurance);
        } else {
            // Create new record if none exists
            $insurance = PatientInsurance::create([
                'patient_id' => $request->user()->id,
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
            ]);
    
            return $this->SuccessResponse(201, "Patient Insurance created successfully", $insurance);
        }
    }
}
