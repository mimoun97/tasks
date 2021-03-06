<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Tests\Feature\Traits\CanLogin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class LoginAltControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;
    /**
     * @test
     */
    public function can_login_a_user()
    {

        $this->withoutExceptionHandling();
        //1
        $user = factory(User::class)->create([
            'name' => 'prova',
            'email' => 'prova@gmail.com',
            'password' => 'secret'
        ]);

        $this->assertNull(Auth::user());
        
        //2
        $response = $this->post('/login_alt',[
            'email' => $user->email,
            'password' => 'secret'
        ]);

        $response->assertStatus(302);

        $response->assertRedirect('/home');

        $this->assertNotNull(Auth::user());

        $this->assertEquals('prova@gmail.com', Auth::user()->email);

        $this->assertAuthenticatedAs($user);

    }
    /**
     * @test
     */
    public function cannot_login_a_user_with_incorrect_password()
    {
        //1 prepare
        $user = factory(User::class)->create([
            'email' => 'prova@gmail.com'
        ]);

        //2 execute
        $response = $this->post('/login_alt',[
            'email' => 'prova@gmail.com',
            'passowrd' => 'asdasdasdasdasdasdd324234234asda'
        ]);

        //3 assert
        $this->assertNotNull($user);
        $this->assertDatabaseHas('users', [ 'email' => 'prova@gmail.com']);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertNull(Auth::user());
        $this->assertGuest();
    }
    /**
     * @test
     */
    public function cannot_login_a_user_with_incorrect_user()
    {
        //1
        $user = factory(User::class)->create([
            'email' => 'prova@gmail.com'
        ]);
        
        //2
        $response = $this->post('/login_alt',[
            'email' => 'proasdasdasdasdva@gmail.com',
            'passowrd' => 'secret'
        ]);
        $this->assertNotNull($user);
        $this->assertDatabaseHas('users', [ 'email' => 'prova@gmail.com']);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertNull(Auth::user());
        $this->assertGuest();
    }
}
