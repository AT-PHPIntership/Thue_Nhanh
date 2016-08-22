<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $user = new User();
        $user->name = 'Son Tran';
        $user->email = 'sontd.it@gmail.com';
        $user->password = bcrypt('12345678');
        $user->activated = 1;
        $user->validation_code = str_random(30);
        $user->save();

        for ($i=0; $i < 100; $i++) {
            $validation_code = str_random(30);
            $activated = rand(0, 5) > 0 ? 1 : 0;
            $user = User::create([
                'name' => $faker->firstName . ' ' . $faker->lastName,
                'email' => $faker->freeEmail,
                'password' => bcrypt('12345678'),
                'activated' => $activated,
                'validation_code' => $validation_code,
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
            ]);
        }
    }
}
