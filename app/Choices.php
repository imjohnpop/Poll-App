<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choices extends Model
{
    //
    protected $fillable = [
        'text',
        'poll_id',
        'nr_votes'
    ];

    protected $guarded = [
        'choices_id'
    ];
}
