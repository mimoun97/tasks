<?php

namespace Tests\Feature\Api;

use App\Task;
use Tests\TestCase;
use Tests\Feature\Traits\CanLogin;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompletedTaskControllerTest extends TestCase
{
    use RefreshDatabase,CanLogin;

    /**
     * @test
     */
    public function guest_user_cannot_complete_a_task()
    {
        //1
        //$this->withoutExceptionHandling();
        $task= Task::create([
            'name' => 'comprar pa',
            'completed' => false
        ]);
        //2

        $response = $this->json('POST', '/api/v1/completed_task/' . $task->id);
        $response->assertStatus(401); //unautheticated
    }

    /**
     * @test
     */
    public function super_admin_can_complete_a_task()
    {
        //1
        $this->withoutExceptionHandling();
        $this->loginAsSuperAdmin('api');
        $task= Task::create([
            'name' => 'comprar pa',
            'completed' => false
        ]);
        //2
        Event::fake();
        Event::assertNotDispatched(\App\Events\Tasks\TaskCompleted::class);

        $response = $this->json('POST', '/api/v1/completed_task/' . $task->id);
        $response->assertSuccessful();
        $task = $task->fresh();

        //3
        $this->assertEquals($task->name, 'comprar pa');
        $this->assertEquals($task->completed, true);

        
        Event::assertDispatched(\App\Events\Tasks\TaskCompleted::class, function ($event) use ($task) {
            return $event->task->id === $task->id;
        });
    }
    /**
     * @test
     */
    public function task_manager_can_complete_a_task()
    {
        //1
        $this->withoutExceptionHandling();
        $this->loginAsTaskManager('api');
        $task= Task::create([
            'name' => 'comprar pa',
            'completed' => false
        ]);
        //2
        Event::fake();
        Event::assertNotDispatched(\App\Events\Tasks\TaskCompleted::class);

        $response = $this->json('POST', '/api/v1/completed_task/' . $task->id);
        $response->assertSuccessful();
        $task = $task->fresh();

        //3
        $this->assertEquals($task->name, 'comprar pa');
        $this->assertEquals($task->completed, true);

        
        Event::assertDispatched(\App\Events\Tasks\TaskCompleted::class, function ($event) use ($task) {
            return $event->task->id === $task->id;
        });
    }
    /**
     * @test
     */
    public function can_complete_a_task()
    {
        //1
        $this->withoutExceptionHandling();
        $this->login('api');
        $task= Task::create([
            'name' => 'comprar pa',
            'completed' => false
        ]);
        //2
        Event::fake();
        Event::assertNotDispatched(\App\Events\Tasks\TaskCompleted::class);

        $response = $this->json('POST', '/api/v1/completed_task/' . $task->id);
        $response->assertSuccessful();
        $task = $task->fresh();

        //3
        $this->assertEquals($task->name, 'comprar pa');
        $this->assertEquals($task->completed, true);

        
        Event::assertDispatched(\App\Events\Tasks\TaskCompleted::class, function ($event) use ($task) {
            return $event->task->id === $task->id;
        });
    }

    /**
     * @test
     */
    public function cannot_complete_a_unexisting_task()
    {
        //1 prepare
        $this->login('api');
        //2 execute
        $response = $this->json('POST','/api/v1/completed_task/1');
        //3 Assert
        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function can_uncomplete_a_task()
    {
        //1
        //$this->withoutExceptionHandling();
        $user = $this->login('api');
        $task= Task::create([
            'name' => 'comprar pa',
            'completed' => true
        ]);
        //2
        Event::fake();
        Event::assertNotDispatched(\App\Events\Tasks\TaskUncompleted::class);
        $response = $this->json('DELETE','/api/v1/completed_task/' . $task->id);
        $response->assertSuccessful();
        $task = $task->fresh();
        $this->assertEquals((boolean) $task->completed, false);

        Event::assertDispatched(\App\Events\Tasks\TaskUncompleted::class, function ($event) use ($task) {
            return $event->task->id === $task->id;
        });
    }

    /**
     * @test
     */
    public function cannot_uncomplete_a_unexisting_task()
    {
        $this->login('api');
        $response= $this->delete('/api/v1/completed_task/1');
        $response->assertStatus(404);
    }
}
