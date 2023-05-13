<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Door;

class DoorController extends Controller
{
    public function info()
    {
        $info = (new Door)->getInfo();
        return response(json_encode($info, JSON_UNESCAPED_UNICODE), 200);
    }
}
