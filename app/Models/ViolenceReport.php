<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViolenceReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'ng_state_id',
        'ng_local_government_id',
        'ng_polling_unit',
        'type_id',
        'title',
        'description',
        'file_path',
        'ip_address',
        'user_agent',
        'longitude',
        'latitude',
    ];
}
