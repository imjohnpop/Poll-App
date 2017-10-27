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
            'poll_name' => 'How much do you like cookies?',
            'is_public' => 1,
            'nr_choice' => 0
        ]);
        
        Votes::create([
            'user_id' => 1,
            'choice_id' => 1
        ]);

        Choices::create([
            'text'=>'A great big lot.',
            'poll_id'=>1,
            'nr_votes'=>0
        ]);

        Choices::create([
            'text'=>'Just a lot.',
            'poll_id'=>1,
            'nr_votes'=>0
        ]);
    }
}
