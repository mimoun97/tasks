<?php

namespace Tests\Unit\Listeners;

use App\Task;
use Tests\TestCase;
use App\Listeners\ForgetCachedTasks;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ForgetCachedTasksTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function can_forget_cached_tasks_key()
    {
        $listener = new ForgetCachedTasks();
        $task = factory(Task::class)->create([
            'name' => 'hola',
            'description' => 'hola'
        ]);
        

        Cache::shouldReceive('forget')
            ->once()
            ->with(Task::TASQUES_CACHE_KEY);

        $listener->handle();

    }
}
