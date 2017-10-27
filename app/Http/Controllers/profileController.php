<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function show() {
        $id = Auth::user()->id;
        $data = User::leftJoin('polls', 'users.id', '=', 'polls.user_id')
            ->leftJoin('choices', 'polls.poll_id', '=', 'choices.poll_id')
            ->leftJoin('votes', 'choices.choices_id', '=', 'votes.choice_id')
            ->where('users.id', '=', $id)->get();
        $view = view('/poll/profile');
        $view->data = $data;
        return $view;
    }
}