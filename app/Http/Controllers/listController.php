<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;
use App\Choices;
use Illuminate\Support\Facades\Auth;

class listController extends Controller
{
    //
    public function list()
    {
        $polls = Poll::get()->where('is_public', 1);
        $choices = Choices::get();

        return view('poll/list', ['polls' => $polls, 'choices' => $choices]);
    }

    public function vote($id)
    {
        $choice = Choice::findOrFail($id);
        
        $choice->fill(request()->only([
            'nr_votes',
        ]));

        $choice->save();
    }
    
    public function store($id = null) {


        if(request()->input('public') == 'on'){
            $public = 1;

        } else {
            $public = 0;

        }

        if(request()->input('multiple') == 'on'){
            $multiple = 1;

        } else {
            $multiple = 0;

        }

        if($id) {
            // select existing object for updating
            $poll = Poll::findOrFail($id);
        } else {
            //prepare new object
            $poll = new Poll();
            $choice = new Choices();
        }


        //insert data
        $poll->fill([
            'poll_name' => request()->input('question'),
            'is_public' => $public,
            'nr_choice' => $multiple,
            'user_id' => Auth::user()->id,
        ]);
        $poll->save();


        $choice->fill([
            'choice_text' => request()->input('question'),
            'choice_id' => 1,
            'choice_to_poll' => $poll->id
        ]);

        // save

        $choice->save();

        // inform user about success

        //redirect
        return redirect()->action('listController@list');
    }
}
