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
        create_example_tags();
        $response = $this->get('/tags');
        $response->assertSuccessful();

        $response->assertViewHas('tags', function ($tags){
            return count($tags) == 3 &&
                $tags[0]['name'] === 'estudis' &&
                $tags[1]['name'] === 'laravel' &&
                $tags[2]['name'] === 'php';
        });
    }


}
