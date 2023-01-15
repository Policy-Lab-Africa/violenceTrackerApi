<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NgState extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_id',
        'name',
        'capital',
        'latitude',
        'longitude',
    ];
}
