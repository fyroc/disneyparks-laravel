<?php

namespace fyroc\DisneyParks\Services;

use Exception;
use fyroc\DisneyParks\Services\DisneyAPI;
use Illuminate\Support\Facades\Log;

class Attraction
{

    public static function getWaitTimesByParkIDWDPRO($parkid, $region='') 
    {
        
        $apiURL = "https://api.wdpro.disney.go.com/global-pool-override-A/facility-service/theme-parks/" . $parkid . "/wait-times";

        return DisneyAPI::connect($apiURL, $region);        
    }
    
    public static function getWaitTimeByIDWDPRO($attractionid, $type, $region='') 
    {
        $apiURL = "https://api.wdpro.disney.go.com/global-pool-override-B/facility-service/attractions/" . $attractionid . ";entityType=" . $type . "/wait-times?region=". $region;;

        return DisneyAPI::connect($apiURL, $region);        
    }
    
    public static function getAttractionByIDWDPRO($attractionID, $type, $region='') 
    {
        $apiURL = "https://api.wdpro.disney.go.com/global-pool-override-B/facility-service/attractions/" . $attractionID . "/;entityType=" . $type . "/?region=". $region;

        return DisneyAPI::connect($apiURL, $region);        
    }
    
    public static function getSchedulesWDPRO($attractionID, $date='', $region='') 
    {
        
        if (strlen($date) > 0) {
            $date = "?date=" . $date;
        }
        
        $apiURL = "https://api.wdpro.disney.go.com/global-pool-override-A/facility-service/schedules/" . $attractionID . "/" . $date;
 
        return DisneyAPI::connect($apiURL, $region);        
    }
    
    public static function getAttractionByID($attractionid, $type, $region='') 
    {
        
        $schedules = '';
        
        $waittime = Self::getWaitTimeByIDWDPRO($attractionid, $type, $region);
        $attraction = Self::getAttractionByIDWDPRO($attractionid, $type, $region);
        $schedule = Self::getSchedulesWDPRO($attractionid, $type, $region);
        
        if (isset($schedule->schedules)) {
            $schedules = $schedule->schedules;
        }

        if (!isset($waittime->waitTime)) {
            $replace = "https://api.wdpro.disney.go.com/global-pool-override-B/facility-service/theme-parks/";
            $parkid = str_replace($replace,"",$attraction->links->ancestorThemePark->href);
            $parkid = str_replace("?region=cn","",$parkid);
            $attractions = collect(Self::getWaitTimesByParkIDWDPRO($parkid, $region)->entries);
            $waittime = $attractions->where("id", $attractionid)->first();
            $waittime = $waittime->waitTime;
        } else {
            $waittime = $waittime->waitTime;
        }
        
        $attractionArray = array(
            "id" => $attraction->id,
            "name" => $attraction->name,
            "type" => $attraction->type,
            "location" => $attraction->coordinates,
            "waitTime" => (isset($waittime)) ? $waittime : "" ,
            "schedules" => $schedules
        );

        return $attractionArray;        
    }
    
    public static function getAttractionsByParkID($parkid, $region='us') 
    {
        try {
            $attractions = Self::getWaitTimesByParkIDWDPRO($parkid, $region)->entries;
            $attractionsArray = array();
            
            $name = '';
            
            if (isset($attraction->name)) {
                $name = $attraction->name;
            }
            
            foreach ($attractions as $attraction) {
                $attractionArray = array();
                $attractionArray = array(
                    "id" => $attraction->id,
                    "name" => (isset($attraction->name)) ?  $attraction->name : "",
                    "type" => $attraction->type,
                    "waitTime" => $attraction->waitTime
                );
                
                $attractionsArray[] = $attractionArray;
            }

            return $attractionsArray; 

        } catch(\Exception $e) {
            Log::error($e->getMessage());
        } 
    }
    
}