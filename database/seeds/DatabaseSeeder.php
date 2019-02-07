<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Model::unguard();
        //create_database();

        // $this->call(UsersTableSeeder::class);
        create_primary_user();
        create_acacha_user();
        create_example_tasks();
        initialize_roles();
        sample_users();
        sample_logs();

        $this->call([
            TagSeeder::class,
            TaskSeeder::class,
            UserSeeder::class
        ]);

        Model::reguard();

    }
}
