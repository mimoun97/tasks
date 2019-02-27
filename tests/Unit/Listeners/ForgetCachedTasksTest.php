<?php

namespace Tests\Unit\Listeners;

use App\Task;
use App\User;
use Tests\TestCase;
use App\Events\Tasks\TaskUpdated;
use App\Events\Tasks\TaskCompleted;
use App\Events\Tasks\TaskDestroyed;
use App\Events\Tasks\TaskUncompleted;
use App\Events\Tasks\TaskStored;
use App\Listeners\ForgetCachedTasks;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ForgetCachedTasksTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function can_forget_cached_tasks_key_when_task_updated()
    {
        $this->withExceptionHandling();

        $listener = new ForgetCachedTasks();

        $user = factory(User::class)->create();

        $task = factory(Task::class)->create([
            'name' => 'hola',
            'description' => 'hola',
            'user_id' => $user->id
        ]);

        Cache::shouldReceive('forget')
            ->once()
            ->with(Task::TASQUES_CACHE_KEY);

        $listener->handle(new TaskUpdated($task));
    }
    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function can_forget_cached_tasks_key_when_task_stored()
    {
        $this->withExceptionHandling();

        $listener = new ForgetCachedTasks();

        $user = factory(User::class)->create();

        $task = factory(Task::class)->create([
            'name' => 'hola',
            'description' => 'hola',
            'user_id' => $user->id
        ]);

        Cache::shouldReceive('forget')
            ->once()
            ->with(Task::TASQUES_CACHE_KEY);

        $listener->handle(new TaskStored($task));
    }
    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function can_forget_cached_tasks_key_when_task_destroyed()
    {
        $this->withExceptionHandling();

        $listener = new ForgetCachedTasks();

        $user = factory(User::class)->create();

        $task = factory(Task::class)->create([
            'name' => 'hola',
            'description' => 'hola',
            'user_id' => $user->id
        ]);

        Cache::shouldReceive('forget')
            ->once()
            ->with(Task::TASQUES_CACHE_KEY);

        $listener->handle(new TaskDestroyed($task));
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function can_forget_cached_tasks_key_when_task_completed()
    {
        $this->withExceptionHandling();

        $listener = new ForgetCachedTasks();

        $user = factory(User::class)->create();

        $task = factory(Task::class)->create([
            'name' => 'hola',
            'description' => 'hola',
            'user_id' => $user->id
        ]);

        Cache::shouldReceive('forget')
            ->once()
            ->with(Task::TASQUES_CACHE_KEY);

        $listener->handle(new TaskCompleted($task));
    }
    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function can_forget_cached_tasks_key_when_task_uncompleted()
    {
        $this->withExceptionHandling();

        $listener = new ForgetCachedTasks();

        $user = factory(User::class)->create();

        $task = factory(Task::class)->create([
            'name' => 'hola',
            'description' => 'hola',
            'user_id' => $user->id
        ]);

        Cache::shouldReceive('forget')
            ->once()
            ->with(Task::TASQUES_CACHE_KEY);

        $listener->handle(new TaskUncompleted($task));
    }
}
