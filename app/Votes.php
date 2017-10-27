<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    //
    protected $fillable = [
        'user_id',
        'choice_id'
    ];

    protected $guarded = [
        'votes_id'
    ];
}
