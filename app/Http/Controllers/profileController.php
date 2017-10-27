<?php

namespace App\Http\Controllers;

use App\Choices;
use App\Poll;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function show() {
        $id = Auth::user()->id;
        $polls = Poll::where('user_id', '=', $id)->get();
        $view = view('/poll/profile');
        $view->polls = $polls;
        return $view;
    }
}