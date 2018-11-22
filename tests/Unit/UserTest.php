<?php
/**
 * Created by PhpStorm.
 * User: mimoun
 * Date: 19/11/18
 * Time: 19:44
 */

namespace Tests\Unit;

use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;


    /**
     * @test
     */
    public function user_can_have_tasks()
    {
        // 1 Preparar
        $user = factory(User::class)->create();
        $task1 = factory(Task::class)->create();
        $task2 = factory(Task::class)->create();
        $task3 = factory(Task::class)->create();
        $user->addTask($task1);
        $user->addTask($task2);
        $user->addTask($task3);

        // 2 executar
        $tasks = $user->tasks;

        // 3 comprovar
        $this->assertTrue($tasks[0]->is($task1));
        $this->assertTrue($tasks[1]->is($task2));
        $this->assertTrue($tasks[2]->is($task3));
    }

    /**
     * @test
     */
    public function user_tasks_returns_null_when_no_tasks()
    {
        // 1 Preparar
        $user = factory(User::class)->create();

        // 2 executar
        $tasks = $user->tasks;

        // 3 comprovar
        $this->assertEmpty($tasks);
    }

    /**
     * @test
     */
    public function can_add_task_to_user()
    {
        // 1 Preparar
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create();

        $user->addTask($task);

        // 2 executar
        $tasks = $user->tasks;

        // 3 comprovar
        $this->assertTrue($tasks[0]->is($task));
    }

    /**
     * @test
     */
    public function can_add_tasks_to_user()
    {
        // 1 Preparar
        $user = factory(User::class)->create();
        $task1 = factory(Task::class)->create();
        $task2 = factory(Task::class)->create();
        $task3 = factory(Task::class)->create();
//        $tasks = [$task1, $task2, $task3];
        $tasks = [];
        array_push($tasks, $task1);
        array_push($tasks, $task2);
        array_push($tasks, $task3);

        // 2 executar
        $user->addTasks($tasks);

        // 3 comprovar
        $tasks = $user->tasks;
        $this->assertTrue($tasks[0]->is($task1));
        $this->assertTrue($tasks[1]->is($task2));
        $this->assertTrue($tasks[2]->is($task3));
    }

    /**
     * @test
     */
    public function isSuperAdmin()
    {
        $user = factory(User::class)->create();

        $this->assertFalse($user->isSuperAdmin());

        $user->admin = true;

        $user->save();

        $this->assertTrue($user->isSuperAdmin());
    }

    /**
     * @test
     */
    public function map()
    {
        $user = factory(User::class)->create([
            'name' => 'Benito Camelas',
            'email' => 'benito@gmail.com',
        ]);

        $mappedUser = $user->map();

        $this->assertEquals($mappedUser['name'], 'Benito Camelas');
        $this->assertEquals($mappedUser['email'], 'benito@gmail.com');
        $this->assertEquals($mappedUser['avatar'], 'https://www.gravatar.com/avatar/' . md5('benito@gmail.com'));
    }

    /**
     * @test
     */
    public function regulars()
    {
        $this->assertCount(0, User::regular()->get());

        $user1 = factory(User::class)->create([
            'name' => 'Benito Camelas',
            'email' => 'benito@gmail.com',
        ]);

        $user2 = factory(User::class)->create([
            'name' => 'mimoun haddou',
            'email' => 'mimoun@gmail.com',
        ]);

        $user3 = factory(User::class)->create([
            'name' => 'prova cognom',
            'email' => 'prova@gmail.com',
        ]);


        $users = [$user1, $user2, $user3];

        $user3->admin = true;
        $user3->save();

        $this->assertCount(2, $regularusers = User::regular()->get());

        $this->assertEquals($regularusers[0]->name, 'Benito Camelas');
        $this->assertEquals($regularusers[1]->name, 'mimoun haddou');

        try {
            //$this->assertNull($regularusers[2]);
        } catch (ErrorException $e) {

        }

    }
}
