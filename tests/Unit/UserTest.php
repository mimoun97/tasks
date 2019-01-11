<?php
/**
 * Created by PhpStorm.
 * User: mimoun
 * Date: 19/11/18
 * Time: 19:44
 */

namespace Tests\Unit;

use App\Avatar;
use App\Photo;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
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
        $task2 = factory(Task::class)->create();

        $user->addTask($task);
        $user->addTask($task2);

        // 2 executar
        $tasks = $user->tasks;

        // 3 comprovar
        $this->assertTrue($tasks[0]->is($task));
        $this->assertTrue($tasks[1]->is($task2));
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

        $this->assertNotNull($user);

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
        $this->assertEquals($mappedUser['gravatar'], 'https://www.gravatar.com/avatar/' . md5('benito@gmail.com'));
        $this->assertEquals($mappedUser['admin'], false);

        $this->assertCount(0, $mappedUser['roles']);
        $this->assertCount(0, $mappedUser['permissions']);

        $role = Role::create([
            'name' => 'Rol'
        ]);

        $role1 = Role::create([
            'name' => 'Rol1'
        ]);

        $permission = Permission::create([
            'name' => 'Permission'
        ]);

        $permission1 = Permission::create([
            'name' => 'Permission1'
        ]);

        $user->admin = true;
        $user->save();

        $user = $user->fresh();

        $mappedUser = $user->map();

        $user->givePermissionTo($permission1);
        $user->givePermissionTo($permission);
        $user->assignRole($role1);
        $user->assignRole($role);

        $user = $user->fresh();

        $this->assertEquals($mappedUser['admin'], true);

        $this->assertTrue($user->hasRole('Rol'));
        $this->assertTrue($user->hasRole('Rol1'));

        $this->assertTrue($user->hasPermissionTo('Permission'));
        $this->assertTrue($user->hasPermissionTo('Permission1'));
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
    }

    /**
     * @test
     */
    public function assignPhoto()
    {
        $user = factory(User::class)->create();
        $this->assertNull($user->photo);
        $photo = Photo::create([
            'url' => '/photo1.png',
        ]);
        $user->assignPhoto($photo);
        $user = $user->fresh();
        $this->assertNotNull($user->photo);
        $this->assertEquals('/photo1.png',$user->photo->url);
        $this->assertEquals($user->id,$user->photo->user_id);
    }

    /**
     * @test
     */
    public function addAvatar()
    {
        $user = factory(User::class)->create();
        $this->assertCount(0,$user->avatars);
        $avatar = Avatar::create([
            'url' => '/avatar.png',
        ]);
        $user->addTask($avatar);
        $user = $user->fresh();
        $this->assertCount(1,$user->avatars);
        $this->assertEquals('/avatar.png',$user->avatars[0]->url);
        $this->assertEquals($user->id,$user->avatars[0]->id);
    }
}
