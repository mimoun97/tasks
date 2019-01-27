<?php

namespace Tests\Feature\Api;

use App\Tag;
use App\Task;
use Tests\TestCase;
use Tests\Feature\Traits\CanLogin;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksTagsControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     *
     * @test
     */
    public function task_manager_can_add_tag_to_task()
    {
        $this->withoutExceptionHandling();
        $this->loginAsTaskManager('api');
        $task = Task::create([
            'name' => 'Hola'
        ]);

        $tag = Tag::create([
            'name' => 'casa',
            'description' => 'estic a casa',
            'color' => 'green'
        ]);

        $response = $this->json('PUT', '/api/v1/tasks/' . $task->id . '/tags/', [
            'tags' => [$tag->id]
        ]);

        $response->assertSuccessful();

        $task = $task->fresh();

        $this->assertCount(1, $task->tags);
        $this->assertEquals('home', $task->tags[0]->name);
        $this->assertTrue($task->tags[0]->is($tag));
    }

    /**
     *
     * @test
     */
    public function guest_user_can_not_add_tag_to_task()
    {
        $this->withoutExceptionHandling();
        $task = Task::create([
            'name' => 'Hola'
        ]);

        $tag = Tag::create([
            'name' => 'casa',
            'description' => 'estic a casa',
            'color' => 'green'
        ]);

        $response = $this->json('PUT', '/api/v1/tasks/' . $task->id . '/tags/', [
            'tags' => [$tag->id]
        ]);

        $response->assertStatus(403);
    }

    /**
     *
     * @test
     */
    public function task_manager_user_can_not_add_tag_to_task()
    {
        $this->withoutExceptionHandling();
        $this->loginAsTaskManager('api');
        $task = Task::create([
            'name' => 'Hola',
            'description' => 'hola',
            'completed' => false
        ]);

        $tag = Tag::create([
            'name' => 'casa',
            'description' => 'estic a casa',
            'color' => 'green'
        ]);

        $response = $this->json('PUT', '/api/v1/tasks/' . $task->id . '/tags/', [
            'tags' => [$tag->id]
        ]);

        dd($response);

        $response->assertStatus(403);
    }
}
