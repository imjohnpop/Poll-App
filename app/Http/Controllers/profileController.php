<?php

namespace App\Http\Controllers;

use App\Choices;
use App\Poll;
use App\User;
use App\Votes;
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

    public function destroy($idcko) {
        $id = Auth::user()->id;
        $polls = Poll::where('user_id', '=', $id)->get();
        Poll::where('poll_id', $idcko)->delete();
        Choices::where('choice_to_poll', $idcko)->delete();
        Votes::where('vote_to_poll', $idcko)->delete();
        $view = view('/poll/profile');
        return redirect()->action('profileController@show');
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
            'choice_text' => request()->input('option_one'),
            'choice_id' => 1,
            'choice_to_poll' => $poll->id
        ]);

        if(request()->input('option_two') !== null){
            $choice_two = new Choices();
            $choice_two->fill([
                'choice_text' => request()->input('option_two'),
                'choice_id' => 1,
                'choice_to_poll' => $poll->id
            ]);
            $choice_two->save();
        }

        if(request()->input('option_three') !== null){
            $choice_three = new Choices();
            $choice_three->fill([
                'choice_text' => request()->input('option_three'),
                'choice_id' => 1,
                'choice_to_poll' => $poll->id
            ]);
            $choice_three->save();
        }


        // save

        $choice->save();

        // inform user about success

        //redirect
        return redirect()->action('profileController@show');
    }
}