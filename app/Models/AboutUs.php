<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $table = 'aboutus';

    protected $fillable = [
        'who_we_are_image',
        'who_we_are_caption',
        'who_we_are_body',
        'mission_image',
        'mission_caption',
        'mission_body',
        'values_caption',
        'values_body',
        'expertise_caption',
        'expertise_body',
        'inspiration_caption',
        'inspiration_body',
        'banner_image'
    ];
}
