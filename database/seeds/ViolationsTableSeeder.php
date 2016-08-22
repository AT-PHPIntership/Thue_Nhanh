<?php

use Illuminate\Database\Seeder;
use App\Models\Violation;
use App\Models\Report;
use Faker\Factory as Faker;

class ViolationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $reports = Report::where('processed', '=', '1')->get();
        foreach ($reports as $report) {
            $violation = new Violation();
            $violation->report_id = $report->id;
            $violation->reviewer_id = rand(1, 101);
            $violation->description = $faker->text(rand(10, 30));
            $violation->save();
        }
    }
}
