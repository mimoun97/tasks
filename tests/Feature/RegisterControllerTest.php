<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class RegisterControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    use RefreshDatabase;

    /**
     * @test
     */
    public function can_register_a_user()
    {
        $this->withoutExceptionHandling();
        //1
        $this->assertNull(Auth::user());
        initialize_roles();

        //$response = $this->post('/register');
//        dd($response);

        $response = $this->post('/register',$user = [
            'name' => 'pepito',
            'email' => 'prova@gmail.com', //$user->email
            'password' => 'asdjaskdlasdasd0798asdjh',
            'password_confirmation' => 'asdjaskdlasdasd0798asdjh'
        ]);

        $response->assertStatus(302);

        $response->assertRedirect('/home');

        $this->assertNotNull(Auth::user());

        $this->assertEquals($user['email'], Auth::user()->email);

        $this->assertEquals($user['name'], Auth::user()->name);

        $this->assertTrue(Hash::check($user['password'], Auth::user()->password));

        $this->assertTrue(Auth::user()->hasRole('Tasks'));

    }



}
