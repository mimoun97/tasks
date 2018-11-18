<?php

namespace Tests\Feature\Api;

use App\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class TagsControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * @test
     */
    public function can_show_a_tag()
    {
        $this->login('api');
        $tag = factory(Tag::class)->create();

        $response = $this->json('GET','/api/v1/tags/' . $tag->id);

        $result = json_decode($response->getContent());
        //dd($tag);
        //dd($result);
        $response->assertSuccessful();
        $this->assertEquals($tag->name, $result->name);
        $this->assertEquals($tag->description, $result->description);
        //dd($tag->color);
        //dd($result->color);
        $this->assertEquals($tag->color, $result->color);
    }

    /**
     * @test
     */
    public function can_delete_tag()
    {
        $this->login('api');
        $tag = factory(Tag::class)->create();

        $response = $this->json('DELETE','/api/v1/tags/' . $tag->id);

        $result = json_decode($response->getContent());
        //dd($result);
        $response->assertSuccessful();
        $this->assertEquals(null, $result);

        $this->assertNull(Tag::find($tag->id));
    }

    /**
     * @test
     */
    public function cannot_create_tags_without_name()
    {
        $this->login('api');

        $response = $this->json('POST','/api/v1/tags/',[
            'name' => ''
        ]);
        //dd($response);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function can_create_tag()
    {
        $this->login('api');
        $response = $this->json('POST','/api/v1/tags/',[
            'name' => 'Business',
            'description' => 'Tag de business',
            'color' => '#FFFFFF'
        ]);

        $result = json_decode($response->getContent());
        //dd($result);
        $response->assertSuccessful();

//        $this->assertDatabaseHas('tags', [ 'name' => 'Comprar pa' ]);
        $this->assertNotNull($tag = Tag::find($result->id));
        $this->assertEquals('Business',$result->name);
        $this->assertEquals('Tag de business',$result->description);
        $this->assertEquals('#FFFFFF',$result->color);
    }

    /**
     * @test
     */
    public function can_list_tags()
    {
        $this->login('api');

        create_example_tags();

        $response = $this->json('GET','/api/v1/tags');
        $response->assertSuccessful();

        $result = json_decode($response->getContent());

        $this->assertCount(3,$result);

        $this->assertEquals('estudis', $result[0]->name);
        $this->assertEquals('relacionat amb estudis',$result[0]->description);
        $this->assertEquals('#FFFFFF',$result[0]->color);

        $this->assertEquals('laravel', $result[1]->name);
        $this->assertEquals('relacionat amb laravel',$result[1]->description);
        $this->assertEquals('#FFFFFF',$result[1]->color);

        $this->assertEquals('php', $result[2]->name);
        $this->assertEquals('relacionat amb php',$result[2]->description);
        $this->assertEquals('#FFFFFF',$result[2]->color);

    }

    /**
     * @test
     */
    public function can_edit_tag()
    {
        $this->login('api');

        $oldtag = factory(Tag::class)->create([
            'name' => 'Business',
            'description' => 'Tag de business',
            'color' => '#FFFFFF'
        ]);

        // 2
        $response = $this->json('PUT','/api/v1/tags/' . $oldtag->id, [
            'name' => 'laravel',
            'description' => 'laravel laravel laravel',
            'color' => '#002500'
        ]);

        $result = json_decode($response->getContent());
        //dd($result);
        //dd($response);
        $response->assertSuccessful();

        //dd($result->description);
        $newtag = $oldtag->refresh();
        $this->assertNotNull($newtag);
        $this->assertEquals('laravel',$result->name);
        $this->assertEquals('laravel laravel laravel',$result->description);
        $this->assertEquals('#002500',$result->color);
    }

    /**
     * @test
     */
    public function cannot_edit_tag_without_name()
    {
        $this->login('api');

        $oldtag = factory(tag::class)->create();
        $response = $this->json('PUT','/api/v1/tags/' . $oldtag->id, [
            'name' => ''
        ]);

        $response->assertStatus(422);
    }
}
