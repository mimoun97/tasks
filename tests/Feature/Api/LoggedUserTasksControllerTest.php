<?php

namespace Tests\Feature\Api;

use App\Task;
use App\User;
use Tests\TestCase;
use Tests\Feature\Traits\CanLogin;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoggedUserTasksControllerTest extends TestCase
{

    use RefreshDatabase, CanLogin;

    /**
     * @test
     */
    public function logged_user_tasks_can_list_his_tasks()
    {
        $this->withoutExceptionHandling();
        // 1 Preparació
        $user = $this->loginAsTasksUser('api');

        $task1 = factory(Task::class)->create();
        $task2 = factory(Task::class)->create();
        $task3 = factory(Task::class)->create();

        $tasks = [$task1, $task2, $task3];
        $user->addTasks($tasks);

        // 2 execute
        $response = $this->json('GET', '/api/v1/user/tasks');
        $response->assertSuccessful();

        $result = json_decode($response->getContent());

        $this->assertCount(3, $result);
        $this->assertEquals($result[0]->id, $task1->id);
        $this->assertEquals($result[1]->id, $task2->id);
        $this->assertEquals($result[2]->id, $task3->id);
    }

    /**
     * @test
     */
    public function cannot_list_user_tasks_if_user_is_not_logged()
    {
        $response = $this->json('GET', '/api/v1/user/tasks');
        $response->assertStatus(401);
    }

    /**
     * @test
     */
    public function cannot_list_user_tasks_if_user_has_no_permission()
    {
        $this->login();
        $response = $this->json('GET', '/api/v1/user/tasks');
        $response->assertStatus(401);
    }

    /**
     * @test
     */
    public function cannot_edit_a_task_not_associated_to_user()
    {
        $this->withExceptionHandling();

        $user = $this->loginAsTasksUser('api');

        $oldTask = factory(Task::class)->create([
            'name' => 'Comprar llet'
        ]);

        // 2
        $response = $this->json('PUT', '/api/v1/user/tasks/' . $oldTask->id, [
            'name' => 'Comprar pa'
        ]);
        $response->assertStatus(404); //findOrFail
    }

    /**
     * @test
     */
    public function logged_user_tasks_can_edit_his_task()
    {
        $this->withoutExceptionHandling();
        $user = $this->loginAsTasksUser('api');

        $oldTask = factory(Task::class)->create([
            'name' => 'Comprar llet',
            'description' => 'comprar',
            'completed' => true,
        ]);
        $user->addTask($oldTask);

        // 2
        $response = $this->json('PUT', '/api/v1/user/tasks/' . $oldTask->id, [
            'name' => 'Comprar pa',
            'description' => 'tornar',
            'completed' => false
        ]);

        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $newTask = $oldTask->refresh();
        $this->assertNotNull($newTask);
        $this->assertEquals($oldTask->id, $result->id);
        $this->assertEquals('Comprar pa', $result->name);
        $this->assertEquals('tornar', $result->description);
        $this->assertFalse((boolean)$newTask->completed);
    }

    /**
     * @test
     */
    public function logged_user_tasks_can_delete_his_tasks()
    {
        $this->withoutExceptionHandling();
        //prepare
        $user = $this->loginAsTasksUser('api');
        $task = factory(Task::class)->create([
            'name' => 'Comprar llet',
            'description' => 'tornar',
            'completed' => false
        ]);
        
        $user->addTask($task);
        //dd($user->tasks()->get());

        //execute
        $response = $this->json('DELETE', '/api/v1/user/tasks/' . $task->id);
        $response->assertSuccessful();
        $task = $task->fresh();

        Event::fake();
        Event::assertNotDispatched(\App\Events\Tasks\TaskDestroyed::class);

        //assert
        $this->assertCount(0, $user->tasks);
        $this->assertNull($task);
        $this->assertDatabaseMissing('tasks', ['name' => 'Comprar llet']);

        Event::assertDispatched(\App\Events\Tasks\TaskDestroyed::class);
        // Event::assertDispatched(\App\Events\Tasks\TaskDestroyed::class, function ($event) use ($task) {
        //     return $event->task->id === $task->id;
        // });
    }

    /**
     * @test
     */
    public function cannot_delete_a_task_not_associated_to_user()
    {
        $this->withExceptionHandling();
        initialize_roles();
        $user = $this->loginAsTasksUser('api');

        $ownerUser = factory(User::class)->create();

        $task = factory(Task::class)->create([
            'name' => 'Comprar llet',
            'description' => 'Bla bla bla',
            'user_id' => $ownerUser->id
        ]);

        $response = $this->json('DELETE', '/api/v1/user/tasks/' . $task->id);
        $response->assertStatus(404); //findOrFail
    }

    /**
     * @test
     */
    public function logged_user_tasks_can_store_a_task_with_his_user_id()
    {
        $this->withoutExceptionHandling();
        $user = $this->loginAsTasksUser('api');

        Event::fake();
        Event::assertNotDispatched(\App\Events\Tasks\TaskStored::class);

        $response = $this->json('POST', '/api/v1/user/tasks/', [
            'name' => 'Comprar pa',
            'description' => 'comprar pa',
            'completed' => true
        ]);

        $result = json_decode($response->getContent());

        $response->assertSuccessful();

        $this->assertDatabaseHas('tasks', ['name' => 'Comprar pa']);
        $this->assertNotNull($task = Task::find($result->id));
        $this->assertEquals('Comprar pa', $result->name);
        $this->assertEquals('comprar pa', $result->description);
        $this->assertNotNull($task->user_id);
        $this->assertEquals($user->id, $result->user_id);
        $this->assertTrue($result->completed);
        

        Event::assertDispatched(\App\Events\Tasks\TaskStored::class, function ($event) use ($task) {
            return $event->task->id === $task->id;
        });
    }
}
