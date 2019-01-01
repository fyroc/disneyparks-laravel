<?php

namespace fyroc\DisneyParks\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use fyroc\DisneyParks\Services\Park;

class ParkController extends Controller
{

    public function park($parkid, $region='us') 
    {
        $park = Park::getParkByID($parkid, $region);    
        return response()->json($park, 200);   
    }

    public function parks($resortid, $region='us') 
    {
        $parks =  Park::getParksByResortID($resortid, $region);
        return response()->json($parks, 200);   
    }

}
