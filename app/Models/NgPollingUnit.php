<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NgPollingUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_id',
        'name',
        'registration_area_id',
        'precise_location',
        'abbreviation',
        'units',
        'delimitation',
        'remark',
        'ward_id',
        'ward_name',
        'local_government_id',
        'local_government_name',
        'state_id',
        'state_name',
    ];
}
