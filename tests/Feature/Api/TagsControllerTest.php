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
        //$this->login('api');
        $tag = factory(Tag::class)->create();

        $response = $this->json('GET','/api/v1/tags/' . $tag->id);

        $result = json_decode($response->getContent());
        dd($tag);
        //dd($result);
        $response->assertSuccessful();
        $this->assertEquals($tag->name, $result->name);
        $this->assertEquals($tag->description, $result->description);
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
        $response->assertSuccessful();
        $this->assertEquals('', $result);

        $this->assertNull(tag::find($tag->id));
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
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function can_create_tag()
    {
        $this->login('api');
        $response = $this->json('POST','/api/v1/tags/',[
            'name' => 'Comprar pa'
        ]);

        $result = json_decode($response->getContent());
        $response->assertSuccessful();

//        $this->assertDatabaseHas('tags', [ 'name' => 'Comprar pa' ]);
        $this->assertNotNull($tag = Tag::find($result->id));
        $this->assertEquals('Comprar pa',$result->name);
        $this->assertFalse($result->completed);
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

        $this->assertEquals('comprar pa', $result[0]->name);
        $this->assertFalse((boolean)$result[0]->completed);

        $this->assertEquals('comprar llet', $result[1]->name);
        $this->assertFalse((boolean) $result[1]->completed);

        $this->assertEquals('Estudiar PHP', $result[2]->name);
        $this->assertTrue((boolean) $result[2]->completed);
    }

    /**
     * @test
     */
    public function can_edit_tag()
    {
        $this->login('api');

        $oldtag = factory(Tag::class)->create([
            'name' => 'Comprar llet'
        ]);

        // 2
        $response = $this->json('PUT','/api/v1/tags/' . $oldtag->id, [
            'name' => 'Comprar pa'
        ]);

        $result = json_decode($response->getContent());
        $response->assertSuccessful();

        $newtag = $oldtag->refresh();
        $this->assertNotNull($newtag);
        $this->assertEquals('Comprar pa',$result->name);
        $this->assertFalse((boolean) $newtag->completed);
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
