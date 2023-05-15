<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Window;

class WindowController extends Controller
{
    public function info()
    {
        $info = (new Window)->getInfo();
        return response(json_encode($info, JSON_UNESCAPED_UNICODE), 200);
    }
}
