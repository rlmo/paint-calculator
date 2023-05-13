<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PaintCan;

class PaintCanController extends Controller
{
    public function info()
    {
        $info = (new PaintCan)->getInfo();
        return response(json_encode($info, JSON_UNESCAPED_UNICODE), 200);
    }
}
