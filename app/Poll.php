<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    //
    protected $primaryKey = 'poll_id';

    protected $fillable = [
        'user_id',
        'poll_name',
        'is_public',
        'nr_choice'
    ];

    protected $guarded = [
        'poll_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
