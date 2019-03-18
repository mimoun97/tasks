<?php

namespace Tests\Feature\Newsletters;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;

class NewslettersControllerTest extends TestCase
{
    use CanLogin, RefreshDatabase;
    /**
     * A basic test example.
     * @test
     */
    public function newsletters_manager_can_show_newsletter_module()
    {
        $this->withoutExceptionHandling();
        $this->loginAsNewslettersManager('web');
        $response = $this->get('/newsletters');
        $response->assertSuccessful();
        $response->assertViewIs('newsletters.index');

        $response->assertViewHas('newsletter',function( $newsletter) {
            return $newsletter instanceof \Illuminate\Support\Collection;
        });
    }
}
