<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=0; $i < 15; $i++) {
            $nbWords = rand(2, 4);
            $cateName = $faker->words($nbWords, $asText = true);
            $cate = Category::create([
                'name' => $cateName,
                'slug' => str_slug($cateName),
            ]);
        }
    }
}
