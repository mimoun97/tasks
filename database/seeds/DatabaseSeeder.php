<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        create_primary_user();
        create_acacha_user();
        create_example_tasks();
        initialize_roles();
        sample_users();

        $this->call([
            UserSeeder::class,
            TagSeeder::class,
            //TaskTableSeeder::class,
        ]);

    }
}
