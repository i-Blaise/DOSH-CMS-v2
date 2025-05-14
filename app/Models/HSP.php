<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HSP extends Model
{
    use HasFactory;

    protected $table = 'hsp';

    protected $fillable = [
        'hospital_name',
        'country',
        'region_name',
        'district',
        'phone_number1',
        'phone_number2',
        'phone_number3',
        'email',
        'latitude',
        'longitude',
        'location_address'
    ];
}
