<?php

namespace App\Http\Controllers;

use App\Poll;
use Illuminate\Http\Request;

class indexController extends Controller
{

    public function index() {
        $view = view('poll/homepage');
        $data = Poll::where('is_public', 1)->paginate(3);
        $view->data = $data;
        return $view;
    }
}
