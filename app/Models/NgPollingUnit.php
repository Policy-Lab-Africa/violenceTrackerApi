<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Znck\Eloquent\Traits\BelongsToThrough;

class NgPollingUnit extends Model
{
    use HasFactory, BelongsToThrough;

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

    public function ward()
    {
        return $this->belongsTo(NgWard::class, 'ward_id', 'data_id');
    }

    public function localGovernment()
    {
        return $this->belongsToThrough(NgLocalGovernment::class, NgWard::class, null,
        '',
        [NgWard::class => 'ward_id', NgLocalGovernment::class => 'local_government_id'],
        );
    }
}
