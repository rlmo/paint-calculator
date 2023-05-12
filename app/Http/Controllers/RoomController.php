<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wall;
use App\Models\PaintCan;

class RoomController extends Controller
{
    public function paintWalls(Request $request)
        {
            $paintArea = 0;
            $walls = $request->all();
    
            foreach($walls as $key => $wall)
            {
                $validationErrors = (new Wall)->wallValidations($key, $wall);
                if(!empty($validationErrors))
                    return json_encode($validationErrors, JSON_UNESCAPED_UNICODE);
    
                $wallArea = (new Wall)->wallArea($wall);
                $paintArea += $wallArea;
            }
    
            $litersNeeded = (new PaintCan)->getLitersNeeded($paintArea);
            $paintCans = (new PaintCan)->paintCansNeeded($paintArea);
    
            $data = [
                "paintArea" => $paintArea,
                "litersNeeded" => $litersNeeded,
                "paintCans" => $paintCans,
            ];
    
            return response(json_encode($data, JSON_UNESCAPED_UNICODE))
                    ->header('Content-Type', 'application/json');
        }
}
