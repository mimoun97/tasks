<?php

use App\Task;
use App\User;
use Illuminate\Container\factory;
use Faker\Generator as Faker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

if (!function_exists('create_primary_user')) {
    function create_primary_user() {
        $user = User::where('email', 'mimounhaddou@iesebre.com')->first();
        if (!$user) {
            User::firstOrCreate([
                'name' => 'Mimoun Haddou',
                'email' => 'mimounhaddou@iesebre.com',
                'password' => bcrypt(env('PRIMARY_USER_PASSWORD','secret'))
            ]);
        }
    }
}
if (!function_exists('create_example_tasks')) {
    function create_example_tasks() {
        Task::create([
            'name' => 'comprar pa',
            'completed' => false
        ]);

        Task::create([
            'name' => 'comprar llet',
            'completed' => false
        ]);

        Task::create([
            'name' => 'Estudiar PHP',
            'completed' => true
        ]);
    }
}

if (!function_exists('initialize_roles')) {
    function initialize_roles() {
        //Crear roles
        $taskManager = Role::create([
            'name' => 'TaskManager'

        ]);

        $taskManager = Role::create([
            'name' => 'TaskManager'

        ]);

        //Create permisos
        Permission::create([
            'name' => 'tasks.index'
        ]);
        Permission::create([
            'name' => 'tasks.store'
        ]);
        Permission::create([
            'name' => 'tasks.update'
        ]);
        Permission::create([
            'name' => 'tasks.destroy'
        ]);
        Permission::create([
            'name' => 'tasks.show'
        ]);



        //Assignar permissos
        $taskManager->givePermissionsTo('tasks.index');
        $taskManager->givePermissionsTo('tasks.store');
        $taskManager->givePermissionsTo('tasks.update');
        $taskManager->givePermissionsTo('tasks.destroy');
        $taskManager->givePermissionsTo('tasks.show');

    }
}

if (!function_exists('initialize_roles')) {
    function initialize_roles() {
        //Crear roles
        $user = factory(User::class)->create([
            'name' => 'Pepe'

        ]);


    }
}



//TODO Crear multiples usauris amb diferents rols
//TODO cOM GESTIONAR EL SUPERADMIN