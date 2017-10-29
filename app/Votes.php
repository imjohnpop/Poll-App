<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    //
    protected $fillable = [
        'user_id',
        'vote_to_poll'
    ];

    protected $guarded = [
        'votes_id'
    ];
}
