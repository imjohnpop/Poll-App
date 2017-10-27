<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;

class listController extends Controller
{
    //
    public function list()
    {
        $view = view('poll/list');
        $polls = Poll::get();
        $view->list = $polls;        
        return $view;
    }
}
