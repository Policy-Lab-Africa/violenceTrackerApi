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

    protected $with = ['location'];

    public function location()
    {
        return $this->hasOne(NgPuLocation::class, 'ng_polling_unit_id', 'data_id');
    }

    public function violencereports()
    {
        return $this->hasMany(ViolenceReport::class, 'ng_polling_unit_id', 'data_id');
    }
}
