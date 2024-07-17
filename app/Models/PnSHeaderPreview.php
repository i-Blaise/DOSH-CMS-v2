<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PnSHeaderPreview extends Model
{
    use HasFactory;

    protected $table = 'pns_header_preview';

    protected $fillable = [
        'image',
        'caption',
        'insurance_body'
    ];
}
