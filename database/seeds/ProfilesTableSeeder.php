<?php

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\User;
use Faker\Factory as Faker;

class ProfilesTableSeeder extends Seeder
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
            $warningTimes = rand(-5, 3);
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->gender = rand(0, 1);
            $profile->phone_number = $faker->tollFreePhoneNumber;
            $profile->address = $faker->address;
            $profile->city_id = rand(1, 50);
            $profile->points = rand(0, 500);
            $profile->warning_times = $warningTimes < 0 ? 0 : $warningTimes;
            $profile->save();
        }
    }
}
