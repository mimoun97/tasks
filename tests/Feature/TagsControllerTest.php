<?php

namespace Tests\Feature;

use App\Tag;
use App\Task;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagsControllerTest extends TestCase
{

    use RefreshDatabase, CanLogin;
    /**
     * @test
     */
    public function can_show_tags()
    {
        $this->withoutExceptionHandling();
        $this->login();
        $this->assertAuthenticated();
        
        create_example_tags();
        $response = $this->get('/tags');
        $response->assertSuccessful();

        $response->assertViewHas('tags', function ($tags){
            return count($tags) == 3 &&
                $tags[0]['name'] === 'estudis' &&
                $tags[1]['name'] === 'laravel' &&
                $tags[2]['name'] === 'php';
        });

        $response->assertViewHas('tags', function ($tags){
            return count($tags) == 3 &&
                $tags[0]['name'] === 'estudis' &&
                $tags[1]['name'] === 'laravel' &&
                $tags[2]['name'] === 'php';
        });

        $response->assertViewIs('tags');
    }

    /**
     * @test
     */
    public function guest_user_cannot_show_tags()
    {
        $response = $this->get('/tags');

        $response->assertStatus(302); //found

        $login = $response->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function regular_user_can_show_tags()
    {
        //1 Prepare
        $this->login();
        // 2 execute
        $response = $this->get('/tags');

        //3 Comprovar
        $response->assertStatus(200);
    }


}
