<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class NgState extends Model
{
    use HasFactory, HasRelationships;

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

    public function wards()
    {
        return $this->hasManyThrough(
            NgWard::class,
            NgLocalGovernment::class,
            'state_id', 
            'local_government_id', 
            'data_id', 
            'data_id');
    }

    

    public function pollingUnits()
    {
        return $this->hasManyDeep(
            NgPollingUnit::class,
            [NgLocalGovernment::class, NgWard::class], // Intermediate models,
            [
               'state_id', // Foreign key on the "ng_local_governments" table.
               'local_government_id',    // Foreign key on the "ng_wards" table.
               'ward_id'     // Foreign key on the "ng_polling_units" table.
            ],
            [
              'data_id', 
              'data_id', 
              'data_id'  
            ]
        );
    }
}
