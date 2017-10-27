<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    //
    protected $fillable = [
        'user_id',
        'poll_name',
        'is_public',
        'nr_choice'
    ];

    protected $guarded = [
        'poll_id'
    ];

}
