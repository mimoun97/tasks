<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Tag;
use App\Task;

class HelpersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function creates_primary_user()
    {
        create_primary_user();

        $user = User::where('email', 'mimounhaddou@iesebre.com')->first();

        $this->assertEquals($user->name, 'Mimoun Haddou');
        $this->assertEquals($user->email, 'mimounhaddou@iesebre.com');
        $this->assertTrue(Hash::check(env('PRIMARY_USER_PASSWORD', 'secret'), $user->password));
    }

    /**
     * @test
     */
    public function creates_acacha_user()
    {
        create_acacha_user();
        $user = User::where('email', 'sergiturbadenas@gmail.com')->first();
        $this->assertEquals($user->name, 'Sergi Tur Badenas');
        $this->assertEquals($user->email, 'sergiturbadenas@gmail.com');
        $this->assertTrue(Hash::check(env('PRIMARY_USER_PASSWORD', '123456'), $user->password));
    }

    /**
     * @test
     */
    public function creates_example_tags()
    {
        create_example_tags();

        $tag1 = Tag::where('name', 'estudis')->first();
        $tag2 = Tag::where('name', 'laravel')->first();
        $tag3 = Tag::where('name', 'php')->first();

        $this->assertEquals($tag1->name, 'estudis');
        $this->assertEquals($tag1->description, 'relacionat amb estudis');
        $this->assertEquals($tag1->color, '#FFFFFF');

        $this->assertEquals($tag2->name, 'laravel');
        $this->assertEquals($tag2->description, 'relacionat amb laravel');
        $this->assertEquals($tag2->color, '#FFFFFF');

        $this->assertEquals($tag3->name, 'php');
        $this->assertEquals($tag3->description, 'relacionat amb php');
        $this->assertEquals($tag3->color, '#FFFFFF');
    }

    /**
     * @test
     */
    public function map_collection_with_map_method()
    {
        $task = Task::create([
            'name' => 'comprar pa',
            'completed' => false
        ]);

        $mappedTask = map_collection($task);

        $this->assertInternalType('array',$mappedTask);
    }

        /**
     * @test
     */
    public function map_collection_without_map_method()
    {
        $object = (object) ['a' => 'new object'];

        $mappedObject = map_collection($object);

        $this->assertNull($mappedObject);
    }
}
