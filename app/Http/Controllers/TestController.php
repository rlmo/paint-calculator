<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $collection = collect([
        
        ['id' => '1', 'nome' => 'Chatbot'], ['id' => '2', 'nome' => 'WhatsApp']]);
        $plucked = $collection->pluck('nome');
        
        echo $plucked;
    }
    
}
