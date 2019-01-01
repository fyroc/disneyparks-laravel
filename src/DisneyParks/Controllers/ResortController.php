<?php

namespace fyroc\DisneyParks\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use fyroc\DisneyParks\Services\Resort;

class ResortController extends Controller
{

    public function resort($resortid) 
    {
        $resort = Resort::getResortByID($resortid);    
        return response()->json($resort, 200);    
    }

    public function resorts() 
    {
        $resorts = Resort::getResorts();  
        return response()->json($resorts, 200);      
    }

}
