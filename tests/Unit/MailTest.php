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

        Mail::fake();

        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        Mail::assertNotSent(TestEmail::class);

        Mail::to($user)->send(new TestEmail());

        Mail::assertSent(TestEmail::class);
    }

    /**
     * @test
     */
    public function send_text_email()
    {
        Mail::fake();

        $user = factory(User::class)->create();

        Mail::assertNotSent(TestTextEmail::class);

        Mail::to($user)->send(new TestTextEmail());

        Mail::assertSent(TestTextEmail::class);
    }

    /**
     * @test
     */
    public function send_markdown_email_dinamic()
    {
        Mail::fake();

        $user = factory(User::class)->create();

        Mail::assertNotSent(TestDinamicEmail::class);

        Mail::to($user)->send(new TestDinamicEmail($user));

        Mail::assertSent(TestDinamicEmail::class, function ($mail) use ($user) {
            return $mail->user->id === $user->id;
        });
    }
}
