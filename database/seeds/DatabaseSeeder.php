<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UserRolesTableSeeder::class);
        $this->call(NotificationTypesTableSeeder::class);
        $this->call(ProfilesTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(PhotosTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
        $this->call(ReportsTableSeeder::class);
        $this->call(ViolationsTableSeeder::class);
        $this->call(VotesTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
    }
}
