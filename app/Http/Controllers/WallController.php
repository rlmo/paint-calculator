<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Wall;

class WallController extends Controller
{
    public function rules()
    {
        $rules = (new Wall)->getRules();
        return response(json_encode($rules, JSON_UNESCAPED_UNICODE), 200);
    }
}
