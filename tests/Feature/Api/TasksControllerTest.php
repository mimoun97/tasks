<?php

namespace Tests\Feature\Api;

use App\Task;
use App\User;
use Tests\TestCase;
use Tests\Feature\Traits\CanLogin;
use Illuminate\Support\Facades\Event;
use phpDocumentor\Reflection\Types\Void_;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TasksControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * @test
     */
    public function task_manager_can_show_a_task()
    {
        //$this->withoutExceptionHandling();
        initialize_roles();

        $user = $this->login('api');

        $user->assignRole('TaskManager');

        $user->save();

        $task = factory(Task::class)->create();

        $this->assertNotNull($task);

        $response = $this->json('GET', '/api/v1/tasks/' . $task->id);

        $result = json_decode($response->getContent());
        //dd($result);
        $response->assertSuccessful();
        $this->assertEquals($task->name, $result->name);
        $this->assertEquals($task->description, $result->description);
        $this->assertEquals($task->completed, (boolean)$result->completed);
    }

    /**
     * @test
     */
    public function superadmin_can_show_a_task()
    {
        $user = $this->loginAsSuperAdmin('api');

        $this->assertNotNull($user);

        $task = factory(Task::class)->create();

        $this->assertNotNull($task);

        $response = $this->json('GET', '/api/v1/tasks/' . $task->id);

        $response->assertSuccessful();

        $result = json_decode($response->getContent());

        $this->assertEquals($task->name, $result->name);
        $this->assertEquals($task->description, $result->description);
        $this->assertEquals($task->completed, (boolean)$result->completed);
    }

    /**
     * @test
     */
    public function regular_user_cannot_show_a_task()
    {
        $user = factory(User::class)->create();

        $this->assertNotNull($user);

        $task = factory(Task::class)->create();

        $this->assertNotNull($task);

        $response = $this->json('GET', '/api/v1/tasks/' . $task->id);

        $response->assertStatus(401); //Unauthorized
    }

    /**
     * @test
     */
    public function guest_user_cannot_show_a_task()
    {
        $user = $this->login('api');

        $this->assertNotNull($user);

        $task = factory(Task::class)->create();

        $this->assertNotNull($task);

        $response = $this->json('GET', '/api/v1/tasks/' . $task->id);

        //$response->assertStatus(403);//Forbidden
        $response->assertForbidden(); //403
    }

    /**
     * @test
     */
    public function task_manager_can_delete_task()
    {
        $this->withoutExceptionHandling();
        $user  = $this->loginAsTaskManager('api');

        Event::fake();
        Event::assertNotDispatched(\App\Events\Tasks\TaskDestroyed::class);

        $this->assertNotNull($user);

        $task = factory(Task::class)->create();

        $this->assertNotNull($task);

        $response = $this->json('DELETE', '/api/v1/tasks/' . $task->id);

        $response->assertSuccessful();

        Event::assertDispatched(\App\Events\Tasks\TaskDestroyed::class, function ($event) use ($task) {
            return $event->task->id === $task->id;
        });
    }

    /**
     * @test
     */
    public function superadmin_can_delete_task()
    {
        $user  = $this->loginAsSuperAdmin('api');

        $this->assertNotNull($user);

        $task = factory(Task::class)->create();

        $this->assertNotNull($task);

        //2
        Event::fake();
        Event::assertNotDispatched(\App\Events\Tasks\TaskDestroyed::class);

        $response = $this->json('DELETE', '/api/v1/tasks/' . $task->id);

        $response->assertSuccessful();

        $this->assertNull(Task::find($task->id));

        //3
        Event::assertDispatched(\App\Events\Tasks\TaskDestroyed::class, function ($event) use ($task) {
            return $event->task->id === $task->id;
        });
    }

    /**
     * @test
     */
    public function regular_user_cannot_delete_task()
    {
        //$this->withoutExceptionHandling();

        $this->login('api');

        $task = factory(Task::class)->create();

        $this->assertNotNull($task);

        Event::fake();

        $response = $this->json('DELETE', '/api/v1/tasks/' . $task->id);

        Event::assertNotDispatched(\App\Events\Tasks\TaskDestroyed::class);

        $response->assertStatus(403);

        $this->assertNotNull(Task::find($task->id));
    }

    /**
     * @test
     */
    public function super_admin_cannot_create_tasks_without_name()
    {
        $this->loginAsSuperAdmin('api');

        $response = $this->json('POST', '/api/v1/tasks/', [
            'name' => ''
        ])->assertJson([
            "message" => "The given data was invalid."
        ]);
        //dd($response);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function task_manager_cannot_create_tasks_without_name()
    {
        $this->loginAsSuperAdmin('api');

        $response = $this->json('POST', '/api/v1/tasks/', [
            'name' => ''
        ])->assertJson([
            "message" => "The given data was invalid."
        ]);
        //dd($response);
        $response->assertStatus(422);
    }

    //     /**
    //      * @test
    //      */
    //     public function can_create_task()
    //     {
    //         $this->login('api');
    //         $response = $this->json('POST','/api/v1/tasks/',[
    //             'name' => 'Comprar pa'
    //         ]);

    //         $result = json_decode($response->getContent());
    //         //dd($result);
    //         $response->assertSuccessful();

    // //        $this->assertDatabaseHas('tasks', [ 'name' => 'Comprar pa' ]);
    //         $this->assertNotNull($task = Task::find($result->id));
    //         $this->assertEquals('Comprar pa',$result->name);
    //         $this->assertFalse($result->completed);
    //     }

    /**
     * @test
     */
    public function superadmin_can_create_task()
    {
        $this->withoutExceptionHandling();
        $user = $this->loginAsSuperAdmin('api');

        Event::fake();
        Event::assertNotDispatched(\App\Events\Tasks\TaskStored::class);

        $response = $this->json('POST', '/api/v1/tasks/', [
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
        $this->assertTrue($result->completed);
        $this->assertNull($task->user_id);

        Event::assertDispatched(\App\Events\Tasks\TaskStored::class, function ($event) use ($task) {
            return $event->task->id === $task->id;
        });
    }

    /**
     * @test
     */
    public function superadmin_can_create_full_task()
    {
        $this->withoutExceptionHandling();
        $this->loginAsSuperAdmin('api');

        $user = factory(User::class)->create();

        Event::fake();
        Event::assertNotDispatched(\App\Events\Tasks\TaskStored::class);

        $response = $this->json('POST', '/api/v1/tasks/', [
            'name' => 'Comprar pa',
            'description' => 'comprar pa',
            'completed' => true,
            'user_id' => $user->id
        ]);

        $result = json_decode($response->getContent());

        $response->assertSuccessful();

        $this->assertDatabaseHas('tasks', ['name' => 'Comprar pa']);
        $this->assertNotNull($task = Task::find($result->id));
        $this->assertEquals('Comprar pa', $result->name);
        $this->assertEquals('comprar pa', $result->description);
        $this->assertTrue($result->completed);
        $this->assertEquals($result->user_id, $task->user_id);

        Event::assertDispatched(\App\Events\Tasks\TaskStored::class, function ($event) use ($task) {
            return $event->task->id === $task->id;
        });
    }

    /**
     * @test
     */
    public function task_manager_can_create_task()
    {
        $this->withoutExceptionHandling();
        $this->loginAsTaskManager('api');

        Event::fake();
        Event::assertNotDispatched(\App\Events\Tasks\TaskStored::class);

        $response = $this->json('POST', '/api/v1/tasks/', [
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
        $this->assertTrue($result->completed);
        $this->assertNull($task->user_id);

        Event::assertDispatched(\App\Events\Tasks\TaskStored::class, function ($event) use ($task) {
            return $event->task->id === $task->id;
        });
    }

    /**
     * @test
     */
    public function regular_user_cannot_create_a_task()
    {
        //$this->withoutExceptionHandling();
        $this->login('api');

        Event::fake();
        Event::assertNotDispatched(\App\Events\Tasks\TaskStored::class);

        $response = $this->json('POST', '/api/v1/tasks/', [
            'name' => 'Comprar pa',
            'description' => 'comprar pa',
            'completed' => true
        ]);

        Event::assertNotDispatched(\App\Events\Tasks\TaskStored::class);

        $response->assertStatus(403); //Forbidden
    }


    /**
     * @test
     */
    public function superadmin_can_list_tasks()
    {
        $this->loginAsSuperAdmin('api');

        create_example_tasks();

        $response = $this->json('GET', '/api/v1/tasks');
        $response->assertSuccessful();

        $result = json_decode($response->getContent());
        //dd($result);
        $this->assertCount(3, $result);

        $this->assertEquals('comprar pa', $result[0]->name);
        $this->assertEquals('pa', $result[0]->description);
        $this->assertFalse((boolean)$result[0]->completed);

        $this->assertEquals('comprar llet', $result[1]->name);
        $this->assertEquals('llet', $result[1]->description);
        $this->assertFalse((boolean)$result[1]->completed);

        $this->assertEquals('Estudiar PHP', $result[2]->name);
        $this->assertEquals('php', $result[2]->description);
        $this->assertTrue((boolean)$result[2]->completed);
    }

    /**
     * @test
     */
    public function task_manager_can_list_tasks()
    {
        $this->loginAsTaskManager('api');

        create_example_tasks();

        $response = $this->json('GET', '/api/v1/tasks');
        $response->assertSuccessful();

        $result = json_decode($response->getContent());
        //dd($result);
        $this->assertCount(3, $result);

        $this->assertEquals('comprar pa', $result[0]->name);
        $this->assertEquals('pa', $result[0]->description);
        $this->assertFalse((boolean)$result[0]->completed);

        $this->assertEquals('comprar llet', $result[1]->name);
        $this->assertEquals('llet', $result[1]->description);
        $this->assertFalse((boolean)$result[1]->completed);

        $this->assertEquals('Estudiar PHP', $result[2]->name);
        $this->assertEquals('php', $result[2]->description);
        $this->assertTrue((boolean)$result[2]->completed);
    }

    /**
     * @test
     */
    public function regular_user_cannot_list_tasks()
    {
        //$this->withoutExceptionHandling();
        $this->login('api');

        $response = $this->json('POST', '/api/v1/tasks/', [
            'name' => 'Comprar pa',
            'description' => 'comprar pa',
            'completed' => true
        ]);

        $response->assertStatus(403); //Forbidden
    }

    /**
     * @test
     */
    public function regular_user_cannot_edit_task()
    {
        //$this->withoutExceptionHandling();
        $this->login('api');

        $task = factory(Task::class)->create([
            'name' => 'Comprar pa',
            'description' => 'comprar pa',
            'completed' => true
        ]);

        $this->assertNotNull($task);

        $response = $this->json('PUT', '/api/v1/tasks/' . $task->id, [
            'name' => 'Comprar llet',
            'description' => 'comprar llet',
            'completed' => false
        ]);

        $response->assertStatus(403); //Forbidden
    }

    /**
     * @test
     */
    public function superadmin_can_edit_task()
    {
        $this->withoutExceptionHandling();
        $this->loginAsSuperAdmin('api');

        $oldTask = factory(Task::class)->create([
            'name' => 'Comprar llet',
            'description' => 'comprar llet',
            'completed' => false
        ]);

        Event::fake();
        Event::assertNotDispatched(\App\Events\Tasks\TaskUpdated::class);

        $this->assertNotNull($oldTask);

        $response = $this->json('PUT', '/api/v1/tasks/' . $oldTask->id, [
            'name' => 'Comprar pa',
            'description' => 'comprar pa',
            'completed' => true
        ]);

        $result = json_decode($response->getContent());

        $response->assertSuccessful();

        $newTask = $oldTask->refresh();
        $this->assertNotNull($newTask);
        $this->assertEquals('Comprar pa', $result->name);
        $this->assertEquals('comprar pa', $result->description);
        $this->assertTrue((boolean)$newTask->completed);
        $this->assertNull($newTask->user_id);

        $task = $newTask;
        Event::assertDispatched(\App\Events\Tasks\TaskUpdated::class, function ($event) use ($task) {
            return $event->task->id === $task->id;
        });
    }

    /**
     * @test
     */
    public function task_manager_can_edit_task()
    {
        $this->withoutExceptionHandling();
        $this->loginAsTaskManager('api');

        Event::fake();
        Event::assertNotDispatched(\App\Events\Tasks\TaskUpdated::class);

        $oldTask = factory(Task::class)->create([
            'name' => 'Comprar llet',
            'description' => 'comprar llet',
            'completed' => false
        ]);

        $this->assertNotNull($oldTask);

        $response = $this->json('PUT', '/api/v1/tasks/' . $oldTask->id, [
            'name' => 'Comprar pa',
            'description' => 'comprar pa',
            'completed' => true
        ]);

        $result = json_decode($response->getContent());

        $response->assertSuccessful();

        $newTask = $oldTask->refresh();
        $this->assertNotNull($newTask);
        $this->assertEquals('Comprar pa', $result->name);
        $this->assertEquals('comprar pa', $result->description);
        $this->assertTrue((boolean)$newTask->completed);
        $this->assertNull($newTask->user_id);

        $task = $newTask;
        Event::assertDispatched(\App\Events\Tasks\TaskUpdated::class, function ($event) use ($task) {
            return $event->task->id === $task->id;
        });
    }

    /**
     * @test
     */
    public function superadmin_cannot_edit_task_without_name()
    {
        $this->loginAsSuperAdmin('api');

        $task = factory(Task::class)->create();

        Event::fake();

        $this->assertNotNull($task);
        $response = $this->json('PUT', '/api/v1/tasks/' . $task->id, [
            'name' => ''
        ]);

        Event::assertNotDispatched(\App\Events\Tasks\TaskUpdated::class);

        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function task_manager_cannot_edit_task_without_name()
    {
        $this->loginAsTaskManager('api');

        $task = factory(Task::class)->create();

        Event::fake();

        $this->assertNotNull($task);
        $response = $this->json('PUT', '/api/v1/tasks/' . $task->id, [
            'name' => ''
        ]);

        Event::assertNotDispatched(\App\Events\Tasks\TaskUpdated::class);

        $response->assertStatus(422);
    }
}
