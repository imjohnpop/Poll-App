<?php

namespace App\Http\Controllers;

use App\Choices;
use App\Votes;
use Illuminate\Http\Request;
use App\Poll;
use Illuminate\Support\Facades\Auth;

class listController extends Controller
{
    //
    public function list()
    {
        $polls = Poll::where('is_public', 1)->get();
        $choices = Choices::get();

        return view('poll/list', ['polls' => $polls, 'choices' => $choices]);
    }

    public function view($id)
    {
        $view = view('poll/poll');
        $polls = Poll::where('poll_id', '=', $id)->get();
        $view->polls = $polls;
        return $view;
    }

    public function vote($id=null, Request $request)
    {
        $vote= new Votes;
        $vote->fill([
            'user_id' => Auth::user()->id,
            'vote_to_poll' => $id
        ]);
        $vote->save();
        $choices=Choices::where('choice_to_poll', $id)->get();
        if(request()->input('1') == 'on')
        {
            $votes = $choices[1]->value('nr_votes');
            $votes = $votes + 1;
            $choices[1]->fill([
            'nr_votes' => $votes
            ]);
        }
        //redirect
        return redirect()->action('listController@list');
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
        }


        //insert data
        $poll->fill([
            'poll_name' => request()->input('question'),
            'is_public' => $public,
            'nr_choice' => $multiple,
            'user_id' => Auth::user()->id,
        ]);
        $poll->save();

        if(request()->input('option_one') !== null) {
            $choice_one = new Choices();
            $choice_one->fill([
                'choice_text' => request()->input('option_one'),
                'choice_id' => 1,
                'choice_to_poll' => $poll->poll_id
            ]);
            $choice_one->save();
        }

        if(request()->input('option_two') !== null){
            $choice_two = new Choices();
            $choice_two->fill([
                'choice_text' => request()->input('option_two'),
                'choice_id' => 2,
                'choice_to_poll' => $poll->poll_id
            ]);
            $choice_two->save();
        }

        if(request()->input('option_three') !== null){
            $choice_three = new Choices();
            $choice_three->fill([
                'choice_text' => request()->input('option_three'),
                'choice_id' => 3,
                'choice_to_poll' => $poll->poll_id
            ]);
            $choice_three->save();
        }


        // inform user about success

        //redirect
        return redirect()->action('listController@list');
    }
}
