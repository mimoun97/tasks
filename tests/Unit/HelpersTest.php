<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HelpersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function creates_primary_user()
    {
        create_primary_user();

        $user = User::where('email', 'mimounhaddou@iesebre.com')->first();

        $this->assertEquals($user->name, 'Mimoun Haddou');
        $this->assertEquals($user->email, 'mimounhaddou@iesebre.com');
        $this->assertTrue(Hash::check(env('PRIMARY_USER_PASSWORD', 'secret'), $user->password));
    }

    /**
     * @test
     */
    public function creates_acacha_user()
    {
        create_acacha_user();
        $user = User::where('email', 'sergiturbadenas@gmail.com')->first();
        $this->assertEquals($user->name, 'Sergi Tur Badenas');
        $this->assertEquals($user->email, 'sergiturbadenas@gmail.com');
        $this->assertTrue(Hash::check(env('PRIMARY_USER_PASSWORD', '123456'), $user->password));
    }

    /**
     * @test
     */
    public function creates_example_tasks()
    {
        # code...
    }
}
