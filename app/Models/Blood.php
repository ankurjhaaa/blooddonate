<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blood extends Model
{
    protected $fillable = [
        'type',
        'user_id',
        'blood_group',
        'units',
        'urgency',
        'country',
        'state',
        'district',
        'city',
        'patient_name',
        'donor_name',
        'hospital_name',
        'hospital_location',
        'phone',
        'email',
        'notes',
        'lat',
        'lng',
        'is_active',
    ];

}
