<?php

use Illuminate\Database\Seeder;
use App\Models\Report;
use Faker\Factory as Faker;

class ReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=0; $i < 25; $i++) {
            $report = new Report();
            $report->reporter_id = rand(1, 101);
            $report->post_id = rand(1, 100);
            $report->description = $faker->text(rand(20, 100));
            $report->processed = rand(0, 1);
            $report->save();
        }
    }
}
