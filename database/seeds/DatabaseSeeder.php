<?php

use App\Poll;
use App\Votes;
use App\Choices;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Poll::create([
            'user_id' => 1,
            'poll_name' => 'How much do you like me?',
            'is_public' => 1,
            'nr_choice' => 0
        ]);
        
        Votes::create([
            'user_id' => 1,
            'vote_to_poll' => 1
        ]);

        Choices::create([
            'choice_id'=> 1,
            'choice_text'=>'A lot.',
            'choice_to_poll'=>1,
            'nr_votes'=>0
        ]);

        Choices::create([
            'choice_id'=> 2,
            'choice_text'=>'Just a bit.',
            'choice_to_poll'=>1,
            'nr_votes'=>1
        ]);
    }
}
