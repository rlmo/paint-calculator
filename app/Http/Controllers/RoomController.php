<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaintCan;

class RoomController extends Controller
{
    public function test()
    {
        $sla = (new PaintCan)->calculateNumberPaintCans(64.23);
    }
}
