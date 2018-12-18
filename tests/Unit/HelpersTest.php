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
    public function create_primary_user()
    {
        create_primary_user();

        $user = User::where('email','mimounhaddou@iesebre.com')->first();

        $this->assertEquals($user->name, 'Mimoun Haddou');
        $this->assertEquals($user->email, 'mimounhaddou@iesebre.com');
        $this->assertTrue(Hash::check(env('PRIMARY_USER_PASSWORD','secret'), $user->password));
    }
}
