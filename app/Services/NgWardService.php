<?php

namespace App\Services;

use App\Models\NgWard;
use App\Exceptions\NgWardException;

class NgWardService
{
    public $ngWard;

    public function findWard($ward)
    {
        $ngWard = NgWard::where('data_id', $ward)->orWhere('name', $ward)->first();

        if(!is_null($ngWard))
        {
            $this->setWard($ngWard);

            return $this;
        }

        throw new NgWardException('Ward ('.$ward.') not found');
    }

    public function getWard()
    {
        return $this->ngWard;
    }

    public function setWard(NgWard $ngWard)
    {
        $this->ngWard = $ngWard;
    }
}