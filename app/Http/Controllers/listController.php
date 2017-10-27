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
        $choices = Choices::get();

        return view('poll/list', ['polls' => $polls, 'choices' => $choices]);
    }

    public function vote()
    {
        $request=request();
        return $request;

        $choice->fill(request()->only([
            'nr_votes',
        ]));

        $choice->save();
        return redirect()->action('listController@list');
    }
}
