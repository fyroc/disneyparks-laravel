<?php

namespace fyroc\DisneyParks;

use fyroc\DisneyParks\Services\DisneyAPI;
use fyroc\DisneyParks\Services\Resort;
use fyroc\DisneyParks\Services\Park;
use fyroc\DisneyParks\Services\Attraction;

class DisneyParks
{

    public $resort;

    public $resorts;

    public $park;

    public $parks;

    public $attraction;

    public $attractions;

    public static function resort($resortid)
    {
        return Resort::getResortByID($resortid);
    }

    public static function resorts()
    {
        return Resort::getResorts();
    }

    public static function park($parkid, $region='us')
    {
        return Park::getParkByID($parkid, $region);
    }

    public static function parks($resortid, $region='us')
    {
        return Park::getParksByResortID($resortid, $region);
    }

    public static function attraction($attractionid, $type, $region='us')
    {
        return Attraction::getAttractionByID($attractionid, $type, $region);
    }

    public static function attractions($parkid, $region='us')
    {
        return Attraction::getAttractionsByParkID($parkid, $region);
    }

}
