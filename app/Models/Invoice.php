<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'appointment_id',
        'doctor_id',
        'patient_id',
        'hospital_id',
        'invoice_number',
        'company_address',
        'company_name',
        'invoice_date',
        'tax_number',
        'subtotal',
        'vat',
        'payment_id',
        'paymentstatus',
        'payment_link',
        'paid_at',
    ];

    protected $casts = [
        'invoice_date' => 'datetime',
        'paid_at' => 'datetime',
    ];
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
