<?php

namespace fyroc\DisneyParks\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use fyroc\DisneyParks\Services\Attraction;

class AttractionController extends Controller
{

    public function attraction($attractionid, $type, $region='us') 
    {
        $attraction = Attraction::getAttractionByID($attractionid, $type, $region);
        return response()->json($attraction, 200); 
    }

    public function attractions($parkid, $region='us') 
    {
        $attractions = Attraction::getAttractionsByParkID($parkid, $region);     
        return response()->json($attractions, 200);   
    }

}
