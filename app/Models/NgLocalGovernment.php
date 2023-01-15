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
}
