<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PnSHeader extends Model
{
    use HasFactory;

    protected $table = 'pns_header';

    protected $fillable = [
        'image',
        'caption',
        'insurance_body'
    ];
}
