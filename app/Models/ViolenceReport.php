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
        'ng_polling_unit_id',
        'type_id',
        'title',
        'description',
        'file',
        'ip_address',
        'user_agent',
        'longitude',
        'latitude',
    ];

    public function pollingunit()
    {
        return $this->belongsTo(NgPollingUnit::class, 'data_id', 'ng_polling_unit_id');
    }
}
