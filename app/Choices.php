<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choices extends Model
{
    //
    protected $fillable = [
        'choice_text',
        'choice_to_poll',
        'nr_votes',
        'choice_id'
    ];
}
