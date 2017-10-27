<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class indexController extends Controller
{

    public function index() {
        $view = view('poll/homepage');

        return $view;
    }
}
