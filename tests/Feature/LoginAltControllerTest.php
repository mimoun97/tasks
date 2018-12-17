<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Facades\Auth;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginAltControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function can_login_a_user()
    {
        $this->withoutExceptionHandling();
        //1
        $user = factory(User::class)->create([
            'email' => 'prova@gmail.com'
        ]);
        $this->assertNull(Auth::user());
        //2
        $response = $this->post('/login_alt',[
            'email' => 'prova@gmail.com',
            'password' => 'secret'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/home');
        $this->assertNotNull(Auth::user());
        $this->assertEquals('prova@gmail.com',Auth::user()->email);
    }
    /**
     * @test
     */
    public function cannot_login_a_user_with_incorrect_password()
    {
        //1
        $user = factory(User::class)->create([
            'email' => 'prova@gmail.com'
        ]);
        //2
        $response = $this->post('/login_alt',[
            'email' => 'prova@gmail.com',
            'passowrd' => 'asdasdasdasdasdasdd324234234asd'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertNull(Auth::user());
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
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertNull(Auth::user());
    }
}
