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
            $counter = 0;
            $errors =[];
    
            foreach($walls as $wall)
            {
                $counter++;
                $validationErrors = (new Wall)->wallValidations($wall);
                if($validationErrors["errors"])
                {
                    $errors[0] = true;
                    foreach($validationErrors["errorMessages"] as &$message)
                    {
                        $message = "Parede {$counter}: " . $message;
                    }
                }
    
                array_push($errors, $validationErrors);
                $wallArea = (new Wall)->wallArea($wall);
                $paintArea += $wallArea;
            }

            if(is_bool($errors[0]))
            {
                return response(json_encode($errors, JSON_UNESCAPED_UNICODE), 400)
                    ->header('Content-Type', 'application/json');
                exit;
            }
            $litersNeeded = (new PaintCan)->getLitersNeeded($paintArea);
            $paintCans = (new PaintCan)->paintCansNeeded($paintArea);
    
            $data = [
                "paintArea" => $paintArea,
                "litersNeeded" => $litersNeeded,
                "paintCans" => $paintCans,
            ];
    
            return response(json_encode($data, JSON_UNESCAPED_UNICODE), 200)
                    ->header('Content-Type', 'application/json');
        }
}
