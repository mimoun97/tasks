<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('users')->insert([
//            'name' => str_random(10),
//            'email' => str_random(10).'@gmail.com',
//            'password' => bcrypt('secret'),
//            'email_verified_at' => now(),
//        ]);

        factory(App\User::class, 50)->create()->each(function ($user) {
            $user->tasks()->save(factory(App\Task::class)->make());
        });
    }
}
