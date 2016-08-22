<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=0; $i < 100; $i++) {
            $Chosen = [
                ["date" => "Mon", "chosen" => rand(0, 1)],
                ["date" => "Tue", "chosen" => rand(0, 1)],
                ["date" => "Wed", "chosen" => rand(0, 1)],
                ["date" => "Thur", "chosen" => rand(0, 1)],
                ["date" => "Fri", "chosen" => rand(0, 1)],
                ["date" => "Sat", "chosen" => rand(0, 1)],
                ["date" => "Sun", "chosen" => rand(0, 1)],
            ];
            $choosenDays = json_encode($Chosen);
            $reviewedAt = $faker->dateTimeBetween('-2 years', 'now');
            $nbWords = rand(5, 10);
            $maxNbChars = rand(200, 1500);
            $title = $faker->words($nbWords, $asText = true);
            $post = new Post();
            $post->user_id = rand(1, 101);
            $post->category_id = rand(1, 15);
            $post->city_id = rand(1, 50);
            $post->address = $faker->address;
            $post->lat = $faker->randomFloat(6, -85, 85);
            $post->lng = $faker->randomFloat(6, -180, 180);
            $post->phone_number = $faker->tollFreePhoneNumber;
            $post->type = rand(1, 2);
            $post->title = $title;
            $post->slug = str_slug($title);
            $post->content = $faker->text($maxNbChars);
            $post->cost = rand(5000, 200000);
            $post->time_begin = $faker->time('H:i:s');
            $post->time_end = $faker->time('H:i:s');
            $post->start_date = $faker->date('d-m-Y');
            $post->end_date = $faker->date('d-m-Y');
            $post->chosen_days = $choosenDays;
            $post->views = rand(0, 3000);
            $post->reviewed_by = rand(1, 101);
            $post->reviewed_at = $reviewedAt;
            $post->created_at = $reviewedAt;
            $post->updated_at = $reviewedAt;
            $post->save();
        }
    }
}
