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
}