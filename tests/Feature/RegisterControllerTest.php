<?php

namespace Tests\Feature;

use App\Mail\TestDinamicEmail;
use App\Mail\WelcomeEmail;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

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

        Mail::fake();

        $response = $this->post('/register',$user = [
            'name' => 'pepito',
            'email' => 'pepito@gmail.com', //$user->email
            'password' => 'asdjaskdlasdasd0798asdjh',
            'password_confirmation' => 'asdjaskdlasdasd0798asdjh'
        ]);



//        Mail::assertSent(WelcomeEmail::class, function ($mail) {
//            dd($mail->user);
//            return $mail->user->name == 'pepito';
//        });

        // Assert a message was sent to the given users...
        Mail::assertSent(WelcomeEmail::class, function ($mail) use ($user) {
            //dump($mail);
//            dd($user);
            return $mail->hasTo($user['email']);
        });

        $response->assertStatus(302);

        $response->assertRedirect('/home');

        $this->assertNotNull(Auth::user());

        $this->assertEquals($user['email'], Auth::user()->email);

        $this->assertEquals($user['name'], Auth::user()->name);

        $this->assertTrue(Hash::check($user['password'], Auth::user()->password));

        $this->assertTrue(Auth::user()->hasRole('Tasks'));

    }



}
