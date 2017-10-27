<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class listController extends Controller
{
    //
    public function list()
    {
        $view = view('poll/list');
        
        return $view;
    }
}
