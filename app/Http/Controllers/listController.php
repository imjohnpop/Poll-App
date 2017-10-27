<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;
use App\Choices;

class listController extends Controller
{
    //
    public function list()
    {
        $polls = Poll::get()->where('is_public', 1);
        $choices = Choices::get()->where('choice_to_poll', 1);

        return view('poll/list', ['polls' => $polls, 'choices' => $choices]);
    }
}
