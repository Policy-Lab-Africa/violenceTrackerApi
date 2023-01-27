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

    /**
     * One NgState has many local government areas
     *
     * @return \HasMany
     */
    public function lgas()
    {
        return $this->hasMany(NgLocalGovernment::class, 'state_id', 'data_id');
    }
}
