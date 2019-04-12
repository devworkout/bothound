<?php

namespace DevWorkout\Bothound;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Exfriend\Bothound\BothoundClass
 */
class BothoundFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bothound';
    }
}
