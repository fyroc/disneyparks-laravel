<?php

namespace fyroc\DisneyParks\Services;

use Exception;
use fyroc\DisneyParks\Services\DisneyAPI;

class Park
{

    public static function getParkByIDWDPRO($parkid, $region='') 
    {
        
        $apiURL = "https://api.wdpro.disney.go.com/global-pool-override-A/facility-service/theme-parks/" . $parkid;

        return DisneyAPI::connect($apiURL, $region);        
    }
    
    public static function getParksByResortIDWDPRO($resortid, $region='') 
    {
        
        $apiURL = "https://api.wdpro.disney.go.com/global-pool-override-A/facility-service/destinations/" . $resortid . "/theme-parks";

        return DisneyAPI::connect($apiURL, $region);        
    }
    
    public static function getParkScheduleWDPRO($parkid, $region='') 
    {
        
        $apiURL = "https://api.wdpro.disney.go.com/global-pool-override-A/facility-service/schedules/" . $parkid;

        return DisneyAPI::connect($apiURL, $region);        
    }
    
    public static function getArrayOfParkIDs($resortid, $region='')
    {

        $parkURLs = Self::getParksByResortIDWDPRO($resortid, $region)->entries;
        $parkids = array();
        foreach ($parkURLs as $parkURL) {
            if (\strpos($parkURL->links->self->href, 'global-pool-override-B') !== false) {
                $replace = "https://api.wdpro.disney.go.com/global-pool-override-B/facility-service/theme-parks/";
            } else {
               $replace = "https://api.wdpro.disney.go.com/global-pool-override-A/facility-service/theme-parks/";
            }
            $parkid = str_replace($replace,"",$parkURL->links->self->href);
            $parkids[] = $parkid;
        }

        return $parkids;
    }
    
    public static function getParkByID($parkid, $region='') 
    {
        
        $park = Self::getParkByIDWDPRO($parkid, $region);
        $schedule = Self::getParkScheduleWDPRO($parkid, $region);
        
        $schedules = '';
        if(isset($schedule->schedules)){
            $schedules = $schedule->schedules;
        }
        
        $parkArray = array(
            "id" => $park->id,
            "name" => $park->name,
            "location" => $park->coordinates,
            "schedules" => $schedules
        );

        return $parkArray;        
    }
    
    public static function getParksByResortID($resortid, $region='') 
    {
        
        $parks = Self::getArrayOfParkIDs($resortid, $region);
        $parksArray = array();
        
        foreach ($parks as $parkid) {
            $parkArray = array();
            $park = Self::getParkByIDWDPRO($parkid, $region);
            $parkArray = array(
                "id" => $park->id,
                "name" => $park->name,
                "location" => $park->coordinates
            );
            
            $parksArray[] = $parkArray;
        }

        return $parksArray;        
    }
    
}
