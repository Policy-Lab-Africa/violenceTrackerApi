<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NgPuLocation extends Model
{
    use HasFactory;

    protected $fillable =[
        'ng_polling_unit_id',
        'latitude',
        'longitude',
        'viewport',
        'formatted_address',
        'google_map_url',
        'google_place_id',
    ];

    protected $casts = [
        'viewport' => 'array'
    ];
}
