<?php

use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;
use App\Models\Post;
use App\Models\NotificationType;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::get();

        foreach ($posts as $post) {
            $numberOfNoti = rand(0, 5);
            for ($i=0; $i < $numberOfNoti; $i++) {
                $postNoti = new notification();
                $postNoti->user_id = rand(1, 101);
                $postNoti->post_id = $post->id;
                $postNoti->type_id = rand(1, 3);
                $postNoti->dismissed = rand(0, 1);
                $postNoti->save();
            }

        }
    }
}
