<?php

use Illuminate\Database\Seeder;
use App\Models\Vote;
use App\Models\User;

class VotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::get();
        foreach ($users as $user) {
            $numOfVotes = rand(0, 10);
            if($numOfVotes == 0) {
                continue;
            }
            for ($i=0; $i < $numOfVotes; $i++) {
                $vote = new Vote();
                $vote->user_id = $user->id;
                $vote->post_id = rand(1, 100);
                $vote->save();
            }
        }
    }
}
