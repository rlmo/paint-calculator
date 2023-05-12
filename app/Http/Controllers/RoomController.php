<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wall;
use App\Models\PaintCan;

class RoomController extends Controller
{
    private array $walls = [
        [
            "height" => 3, "witdh" => 12, "doors" => 0, "windows" => 0
        ],
        [
            "height" => 3, "witdh" => 15, "doors" => 1, "windows" => 1
        ],
        [
            "height" => 3, "witdh" => 12, "doors" => 1, "windows" => 0
        ],
        [
            "height" => 3, "witdh" => 15, "doors" => 0, "windows" => 1
        ],
    ];

    public function paintWalls(/*array $walls*/)
    {
        $paintArea = 0;

        foreach($this->walls as $key => $wall)
        {
            $validationErrors = (new Wall)->wallValidations($wall);
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

        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
