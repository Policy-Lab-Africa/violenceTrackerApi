<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NgWard extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_id',
        'name',
        'abbreviation',
        'local_government_id',
    ];

    public function pollingUnits()
    {
        return $this->hasMany(NgPollingUnit::class, 'ward_id', 'data_id');
    }

    public function localGovernment()
    {
        return $this->belongsTo(NgLocalGovernment::class, 'local_government_id', 'data_id');
    }
}
