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

    public function voted($current){
        $id = $this->poll_id;
        $answered=\App\Votes::where('user_id', '=', $current)->get();
        $ids = [];

        foreach ($answered as $val)
        {
            $ids[] = $val->vote_to_poll;
        }

        if(in_array($id, $ids))
        {
            return false;
        }else{
            return true;
        }
    }
}
