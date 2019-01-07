<?php

namespace Tests\Feature\Api;

use App\Task;
use App\User;
use Tests\TestCase;
use Tests\Feature\Traits\CanLogin;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

        $response = $this->json('GET','/api/v1/tasks/' . $task->id);

        $result = json_decode($response->getContent());
        //dd($result);
        $response->assertSuccessful();
        $this->assertEquals($task->name, $result->name);
        $this->assertEquals($task->description, $result->description);
        $this->assertEquals($task->completed, (boolean) $result->completed);
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

        $response = $this->json('GET','/api/v1/tasks/' . $task->id);

        $response->assertSuccessful();

        $result = json_decode($response->getContent());

        $this->assertEquals($task->name, $result->name);
        $this->assertEquals($task->description, $result->description);
        $this->assertEquals($task->completed, (boolean) $result->completed);
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

        $response = $this->json('GET','/api/v1/tasks/' . $task->id);

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

        $response = $this->json('GET','/api/v1/tasks/' . $task->id);

        $response->assertStatus(403);//Forbidden
    }

    /**
     * @test
     */
    public function task_manager_can_delete_task()
    {
        $user  =$this->loginAsTaskManager('api');

        $this->assertNotNull($user);

        $task = factory(Task::class)->create();

        $this->assertNotNull($task);

        $response = $this->json('DELETE','/api/v1/tasks/' . $task->id);

        $response->assertSuccessful();

        $this->assertNull(Task::find($task->id));
    }

        /**
     * @test
     */
    public function superadmin_can_delete_task()
    {
        $user  =$this->loginAsSuperAdmin('api');

        $this->assertNotNull($user);

        $task = factory(Task::class)->create();

        $this->assertNotNull($task);

        $response = $this->json('DELETE','/api/v1/tasks/' . $task->id);

        $response->assertSuccessful();

        $this->assertNull(Task::find($task->id));
    }

    /**
     * @test
     */
    public function regular_user_cannot_delete_task()
    {
        $this->withoutExceptionHandling();

        $this->login('api');

        $task = factory(Task::class)->create();

        $this->assertNotNull($task);

        $response = $this->json('DELETE','/api/v1/tasks/' . $task->id);

        $response->assertStatus(403);

        $this->assertNotNull(Task::find($task->id));
    }

    /**
     * @test
     */
    public function can_delete_task()
    {
        $this->login('api');
        $task = factory(Task::class)->create();

        $response = $this->json('DELETE','/api/v1/tasks/' . $task->id);

        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals('', $result);

        $this->assertNull(Task::find($task->id));
    }

    /**
     * @test
     */
    public function cannot_create_tasks_without_name()
    {
        $this->login('api');

        $response = $this->json('POST','/api/v1/tasks/',[
            'name' => ''
        ]);
        //dd($response);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function can_create_task()
    {
        $this->login('api');
        $response = $this->json('POST','/api/v1/tasks/',[
            'name' => 'Comprar pa'
        ]);

        $result = json_decode($response->getContent());
        //dd($result);
        $response->assertSuccessful();

//        $this->assertDatabaseHas('tasks', [ 'name' => 'Comprar pa' ]);
        $this->assertNotNull($task = Task::find($result->id));
        $this->assertEquals('Comprar pa',$result->name);
        $this->assertFalse($result->completed);
    }

    /**
     * @test
     */
    public function can_list_tasks()
    {
        $this->login('api');

        create_example_tasks();

        $response = $this->json('GET','/api/v1/tasks');
        $response->assertSuccessful();

        $result = json_decode($response->getContent());
        //dd($result);
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
    public function can_edit_task()
    {
        $this->login('api');

        $oldTask = factory(Task::class)->create([
            'name' => 'Comprar llet',
            'description' => 'comprar llet',
            'completed' => false
        ]);

        $this->assertNotNull($oldTask);

        $response = $this->json('PUT','/api/v1/tasks/' . $oldTask->id, [
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
        $this->assertTrue((boolean) $newTask->completed);
    }

    /**
     * @test
     */
    public function cannot_edit_task_without_name()
    {
        $this->login('api');

        $task = factory(Task::class)->create();

        $this->assertNotNull($task);
        $response = $this->json('PUT','/api/v1/tasks/' . $task->id, [
            'name' => ''
        ]);

        $response->assertStatus(422);
    }
}
