<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSections extends Model
{
    use HasFactory;

    protected $fillable = [
        'insurance_image',
        'insurance_caption',
        'insurance_body',
        'finance_caption',
        'finance_body',
        'ride_image',
        'ride_caption',
        'ride_body',
        'erp_image',
        'erp_caption',
        'erp_body',
        'commerce_image',
        'commerce_caption',
        'commerce_body'
    ];
}
