<?php

namespace App\Services;

use App\Models\NgLocalGovernment;
use App\Exceptions\NgLocalGovernmentException;

class NgLocalGovernmentService
{
    public $ngLga;

    public function findLg($lga)
    {
        $ngLga = NgLocalGovernment::where('data_id', $lga)->orWhere('name', $lga)->first();

        if(!is_null($ngLga))
        {
            $this->setLga($ngLga);

            return $this;
        }

        throw new NgLocalGovernmentException('Local government areas ('.$lga.') not found');
    }

    public function getLg()
    {
        return $this->ngLga;
    }

    public function setLga(NgLocalGovernment $ngLga)
    {
        $this->ngLga = $ngLga;
    }
}