<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    protected $with = ['pollingUnit', 'type'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'ip_address',
        'user_agent',
    ];

    /**
     * Get the report's media file.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function file(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (isset($value)) ? Storage::disk('s3')->temporaryUrl($value, now()->addMinutes(30)) : null,
        );
    }

    public function pollingUnit()
    {
        return $this->belongsTo(NgPollingUnit::class, 'ng_polling_unit_id', 'data_id');
    }

    public function type()
    {
        return $this->belongsTo(ViolenceType::class);
    }
}
