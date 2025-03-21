<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceReadMoreModal extends Model
{
    use HasFactory;

    protected $table = 'insurance_readmore_modal';
    protected $fillable = [
        'image',
        'description',
        'references',
        'insurance_name'
    ];
}
