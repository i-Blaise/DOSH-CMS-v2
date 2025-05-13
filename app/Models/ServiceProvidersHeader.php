<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvidersHeader extends Model
{
    use HasFactory;

    protected $table = 'service_providers_header';
    protected $fillable = [
        'image',
        'caption',
        'body'
    ];
}
