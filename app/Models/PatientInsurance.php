<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientInsurance extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'insurance_id',
        'insurance_company_name',
        'medical_network',
        'id_card_number',
        'category',
        'co_payment_percentage',
        'submission_date',
        'subscriber_type',
        'insurance_policy_number',
        'gender',
        'coverage_limits',
        'insurance_expiry_date',
        'subscriber_number',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class);
    }

    public function insurance()
    {
        return $this->belongsTo(Insurance::class);
    }
}
