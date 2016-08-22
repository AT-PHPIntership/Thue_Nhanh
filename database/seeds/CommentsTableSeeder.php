<?php

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\User;
use Faker\Factory as Faker;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $users = User::get();
        foreach ($users as $user) {
            $numOfComments = rand(0, 15);
            if($numOfComments == 0) {
                continue;
            }
            for ($i=0; $i < $numOfComments; $i++) {
                $comment = new Comment();
                $comment->user_id = $user->id;
                $comment->post_id = rand(1, 100);
                $comment->content = $faker->text($maxNbChars = 350);
                $comment->save();
            }
        }
    }
}
