<?php

namespace Tests\Feature;

use App\Task;
use App\User;
use Tests\TestCase;
use Tests\Feature\Traits\CanLogin;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasquesControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * @test
     */
    public function guest_user_cannot_index_tasques()
    {
        $response = $this->get('/tasques');
        $response->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function regular_user_cannot_index_tasques()
    {
        //$this->withoutExceptionHandling();
        $this->login();
        $response = $this->get('/tasques');
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function superadmin_user_can_index_tasques()
    {
        //$this->withoutExceptionHandling();
        $this->loginAsSuperAdmin();
        $response = $this->get('/tasques');
        $response->assertSuccessful();
    }

    /**
     * @test
     */
    public function taskmanager_user_can_index_tasques()
    {
        //$this->withoutExceptionHandling();
        $this->loginAsTaskManager();
        $response = $this->get('/tasques');
        $response->assertSuccessful();
    }

    /**
     * @test
     */
    public function owner_tasks_user_can_index_tasques()
    {
        $this->withoutExceptionHandling();
        create_example_tasks();

        $user = $this->loginAsTasksUser();

        //var_dump($user->getAllPermissions());

        Task::create([
            'name' => 'Comprar pa',
            'completed' => false,
            'description' => 'lorem',
            'user_id' => $user->id
        ]);

        $response = $this->get('/tasques');
        $response->assertSuccessful();

        $response->assertViewIs('tasques');

        $response->assertViewHas('tasks');
        $response->assertViewHas('users');
        $response->assertViewHas('uri');
    }

    /**
     * @test
     */
    public function guest_user_cannot_show_a_task_by_link()
    {
        $this->withExceptionHandling();

        $task = factory(Task::class)->create([
            'name' => 'No copiar',
            'completed' => false,
            'description' => 'Copiant , no s\'apren'
        ]);

        $this->assertNotNull($task);

        $response = $this->get('/tasques/' . $task->id);

        $response->assertRedirect('/login');

        // $this->assertDatabaseMissing('tasks', ['name' => 'No copiar, així no s\'apren']);

        // $response = $this->get('/tasques/');
        // $response->assertRedirect('/login');
    }

    
    /**
     * @test
     */
    public function regular_user_cannot_show_a_task_by_link()
    {
        $this->withExceptionHandling();

        $this->login();
        
        $task = factory(Task::class)->create([
            'name' => 'No copiar',
            'completed' => false,
            'description' => 'Copiant , no s\'apren'
        ]);

        $this->assertNotNull($task);

        $response = $this->get('/tasques/' . $task->id);

        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function superadmin_user_can_show_a_task_by_link()
    {
        $this->withExceptionHandling();

        $this->loginAsSuperAdmin();

        $task = factory(Task::class)->create([
            'name' => 'No copiar',
            'completed' => false,
            'description' => 'Copiant , no s\'apren'
        ]);

        $this->assertNotNull($task);

        $response = $this->get('/tasques/' . $task->id);

        $response->assertSuccessful();

        $response->assertViewIs('tasques_show');

        $response->assertViewHas('task', $task);
        $response->assertViewHas('users');
        $response->assertViewHas('uri', '/api/v1/tasks');

        $response->assertSee($task->name);
    }

    /**
     * @test
     */
    public function taskmanager_user_can_show_a_task_by_link()
    {
        $this->withExceptionHandling();

        $this->loginAsTaskManager();

        $ownerUser = factory(User::class)->create();

        $task = factory(Task::class)->create([
            'name' => 'No copiar',
            'completed' => false,
            'description' => 'Copiant , no s\'apren',
            'user_id' => $ownerUser->id
        ]);

        $this->assertNotNull($task);

        $response = $this->get('/tasques/' . $task->id);

        $response->assertSuccessful();

        $response->assertViewIs('tasques_show');

        $response->assertViewHas('task', $task);
        $response->assertViewHas('users');
        $response->assertViewHas('uri', '/api/v1/tasks');

        $response->assertSee($task->name);
    }

    /**
     * @test
     */
    public function owner_tasks_user_can_show_a_task_by_link()
    {
        $this->withExceptionHandling();

        $user = $this->loginAsTasksUser();

        //var_dump($user->getAllPermissions());

        $task = Task::create([
            'name' => 'Comprar pa',
            'completed' => false,
            'description' => 'lorem',
            'user_id' => $user->id
        ]);

        $this->assertNotNull($task);

        $response = $this->get('/tasques/' . $task->id);

        $response->assertSuccessful();

        $response->assertViewIs('tasques_show');

        $response->assertViewHas('task', $task);
        $response->assertViewHas('users');
        $response->assertViewHas('uri', '/api/v1/user/tasks');

        $response->assertSee($task->name);
    }

    /**
     * @test
     */
    public function tasks_user_can_not_show_a_not_owned_task_by_link()
    {
        //TODO only show a task if you can.
        $this->withExceptionHandling();

        $this->loginAsTasksUser();

        $ownerUser = factory(User::class)->create();

        //var_dump($user->getAllPermissions());

        $task = Task::create([
            'name' => 'Esta tasca no la pots veure',
            'completed' => false,
            'description' => 'bye',
            'user_id' => $ownerUser->id
        ]);

        $this->assertNotNull($task);

        $response = $this->get('/tasques/' . $task->id);

        $response->assertStatus(403);
    }
}
