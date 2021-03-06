<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\User;

class RegisterAltControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_register_a_user()
    {
        $this->withoutExceptionHandling();
        //1
        $this->assertNull(Auth::user());

//        dd($response);

        $response = $this->post('/register_alt',$user = [
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

        $this->assertTrue(Hash::check($user['password_confirmation'], Auth::user()->password));

        $this->assertEquals($user['password'], $user['password_confirmation']);
    }
}
