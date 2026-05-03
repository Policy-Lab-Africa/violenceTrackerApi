<?php

namespace App\Services;

use App\Exceptions\NgStateException;
use App\Models\NgState;

class NgStateService
{
    public $ngState;

    //
    public function __construct(?NgState $ngState = null)
    {
        if (! is_null($ngState)) {
            //
            $this->setState($ngState);
        }
    }

    public function setState(NgState $state)
    {
        $this->ngState = $state;
    }

    public function getState(): NgState
    {
        return $this->ngState;
    }

    /**
     * Find a state using `data_id` or Name
     */
    public function findState(int|string $state): self
    {
        $ngState = NgState::where('data_id', $state)->orWhere('name', $state)->first();

        if (! is_null($ngState)) {
            $this->setState($ngState);

            return $this;
        }

        throw new NgStateException('State ('.$state.') not found');
    }
}
