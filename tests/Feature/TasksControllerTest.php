<?php

namespace Tests\Feature;

use App\Task;
use Tests\TestCase;
use Tests\Feature\Traits\CanLogin;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;
    /**
     * Can show tasks
     * @test
     * @return void
     */
    public function can_show_tasks()
    {
        $this->withExceptionHandling();
        create_example_tasks();

        $this->login();

        $response = $this->get('/tasks');

        $response->assertSuccessful();

        $response->assertViewIs('tasks');

        $response->assertViewHas('tasks');

        
        $response->assertSee('Tasques');
        $response->assertSee('comprar pa');
        $response->assertSee('comprar llet');
        $response->assertSee('Estudiar PHP');
    }

    /**
     * @test
     */
    public function can_store_a_task()
    {
        $this->login();

        $this->assertAuthenticated();

        $response = $this->post('/tasks', [
            'name' => 'No copiar, així no s\'apren'
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('tasks', ['name' => 'No copiar, així no s\'apren']);
    }

    /**
     * @test
     */
    public function cannot_delete_an_unexisting_task()
    {
        $this->login();

        $this->assertAuthenticated();

        $response = $this->delete('/tasks/7');

        $response->assertNotFound(); //404 not-found

    }

        /**
     * @test
     */
    public function can_delete_a_task()
    {
        $this->login();

        $this->assertAuthenticated();

        $task = factory(Task::class)->create([
            'name' => 'No copiar',
            'description' => 'Copiant , no s\'apren'
        ]);

        $response = $this->delete('/tasks/' . $task->id);

        $response->assertStatus(302);

        $this->assertDatabaseMissing('tasks', ['name' => 'No copiar, així no s\'apren']);
    }
}
