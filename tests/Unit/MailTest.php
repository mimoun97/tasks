<?php

namespace Tests\Unit;

use App\Mail\TestDinamicEmail;
use App\Mail\TestEmail;
use App\Mail\TestTextEmail;
use App\User;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MailTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function send_markdown_email()
    {
        //dump(env('MAIL_DRIVER'));
        $user = factory(User::class)->create();
        $user->email = 'mimounhm.97@gmail.com';

        Mail::to($user)->send(new TestEmail());
        $this::assertTrue(true);
    }

    /**
     * @test
     */
    public function send_text_email()
    {
        //dump(env('MAIL_DRIVER'));
        //dump(env('MAIL_HOST'));
        $user = factory(User::class)->create();

        Mail::to($user)->send(new TestTextEmail());
        $this::assertTrue(true);
    }

    /**
     * @test
     */
    public function send_markdown_email_dinamic()
    {
        //dump(env('MAIL_DRIVER'));
        $user = factory(User::class)->create();

        Mail::to($user)->send(new TestDinamicEmail($user));
        $this::assertTrue(true);
    }
}
