<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NgLocalGovernment extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_id',
        'name',
        'abbreviation',
        'state_id',
        'state_name',
    ];

    public function wards()
    {
        return $this->hasMany(NgWard::class, 'local_government_id', 'data_id');
    }
}
