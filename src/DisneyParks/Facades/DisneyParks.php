<?php

namespace fyroc\DisneyParks\Facades;

use Illuminate\Support\Facades\Facade;

class DisneyParks extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'disneyparks';
    }
}
