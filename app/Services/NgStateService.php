<?php

namespace App\Services;

use App\Models\NgState;
use App\Services\NgStateService;
use App\Exceptions\NgStateException;

class NgStateService
{
    public $ngState;
    // 
    public function __construct(NgState $ngState = null)
    {
        if(!is_null($ngState))
        {
            // 
            $this->setState($ngState);
        }
    }

    public function setState(NgState $state)
    {
        $this->ngState = $state;
    }

    public function getState()
    {
        return $this->ngState;
    }

    /**
     * Find a state using ID or Name
     *
     * @param integer|string $state
     * @return self
     */
    public function findState(int|string $state) : self
    {
        $ngState = NgState::where('id', $state)->orWhere('name', $state)->first();

        if(!is_null($ngState))
        {
            $this->setState($ngState);

            return $this;
        }

        throw new NgStateException('State ('.$state.') not found');
    }
}