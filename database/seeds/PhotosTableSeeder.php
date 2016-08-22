<?php

use Illuminate\Database\Seeder;
use App\Models\Photo;
use App\Models\Post;

class PhotosTableSeeder extends Seeder
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
            $numberOfPhotos = rand(1, 6);
            for ($i=0; $i < $numberOfPhotos; $i++) {
                $photo = new Photo();
                $photo->post_id = $post->id;
                $photo->file_name = $post->id."-img-".$i;
                $photo->save();
            }
        }
    }
}
