<?php

namespace Tests\Feature;

use App\Task;
use Tests\TestCase;
use Tests\Feature\Traits\CanLogin;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksVueControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * @test
     */
    public function can_show_vue_tasks()
    {
        $this->withExceptionHandling();
        $this->login();
        create_example_tasks();

        // 2 EXECUTE
        $response = $this->get('/tasks_vue')
            ->assertSee('Tasques Vue i Vuetify')
            ->assertSee('Tasques')
            ->assertDontSee('Welcome');

        $tasks = $response->viewData('tasks');

        // 3 ASSERT
        $response->assertSuccessful();

        $response->assertViewIs('tasks_vue');
        $response->assertViewHas('tasks');



        $this->assertEquals('comprar pa', $tasks[0]->name);
        $this->assertEquals('pa', $tasks[0]->description);
        $this->assertEquals(false, (boolean)$tasks[0]->completed);

        $this->assertEquals('comprar llet', $tasks[1]->name);
        $this->assertEquals('llet', $tasks[1]->description);
        $this->assertEquals(false, (boolean)$tasks[1]->completed);

        $this->assertEquals('Estudiar PHP', $tasks[2]->name);
        $this->assertEquals('php', $tasks[2]->description);
        $this->assertEquals(true, (boolean)$tasks[2]->completed);
    }
}
