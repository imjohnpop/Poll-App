<?php

namespace App\Http\Controllers;

use App\Poll;
use Illuminate\Http\Request;

class indexController extends Controller
{

    public function index() {
        $view = view('poll/homepage');
        $data = Poll::get();
        $view->data = $data;
        return $view;
    }
}
