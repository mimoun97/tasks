<?php

namespace Tests\Feature;

use App\Task;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
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
//        $response->assertViewHas('tasks', function($tasks) {
//            return count($tasks)===1 &&
//                $tasks[0]['name']==='Comprar pa';
//        });
        $response->assertViewHas('tasks');
        $response->assertViewHas('users');
        $response->assertViewHas('uri');
    }
}
