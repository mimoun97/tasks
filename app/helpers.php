<?php

use App\Tag;
use App\Task;
use App\User;
use Illuminate\Container\factory;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

if (!function_exists('create_primary_user')) {
    function create_primary_user() {
        $user = User::where('email', 'mimounhaddou@iesebre.com')->first();
        if (!$user) {
            $user= User::firstOrCreate([
                'name' => 'Mimoun Haddou',
                'email' => 'mimounhaddou@iesebre.com',
                'password' => bcrypt(env('PRIMARY_USER_PASSWORD','secret'))
            ]);

            $user->admin = true;
            $user->save();
        }
    }
}


if (!function_exists('create_acacha_user')) {
    function create_acacha_user() {
        $user = User::where('email', 'sergiturbadenas@gmail.com')->first();
        if (!$user) {
            $user= User::firstOrCreate([
                'name' => 'Sergi Tur Badenas',
                'email' => 'sergiturbadenas@gmail.com',
                'password' => bcrypt(env('PRIMARY_USER_PASSWORD','123456'))
            ]);

            $user->admin = true;
            $user->save();
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
        // Crear roles
        try {
            $taskManager = Role::create([
                'name' => 'TaskManager'
            ]);
        } catch(Exception $e) {

        }

        try {
            $tasks = Role::create([
                'name' => 'Tasks'
            ]);
        } catch(Exception $e) {

        }


        // Crear permisos

        // CRUD de tasques
        try {
            Permission::create([
                'name' => 'tasks.index'
            ]);
            //
//        Gate::define('tasks.index', function ($user) {
//            return $user->hasPermission('tasks.index');
//        });

            Permission::create([
                'name' => 'tasks.show'
            ]);
            Permission::create([
                'name' => 'tasks.store'
            ]);
            Permission::create([
                'name' => 'tasks.update'
            ]);
            Permission::create([
                'name' => 'tasks.complete'
            ]);
            Permission::create([
                'name' => 'tasks.uncomplete'
            ]);
            Permission::create([
                'name' => 'tasks.destroy'
            ]);
        }  catch(Exception $e) {

        }

        try {
            // Assignar permissos a TaskManager
            $taskManager->givePermissionTo('tasks.index');
            $taskManager->givePermissionTo('tasks.show');
            $taskManager->givePermissionTo('tasks.store');
            $taskManager->givePermissionTo('tasks.update');
            $taskManager->givePermissionTo('tasks.complete');
            $taskManager->givePermissionTo('tasks.uncomplete');
            $taskManager->givePermissionTo('tasks.destroy');
        } catch(Exception $e) {

        }

        try {
            // CRUD TASQUES D'UN USUARI
            Permission::create([
                'name' => 'user.tasks.index'
            ]);
            Permission::create([
                'name' => 'user.tasks.show'
            ]);
            Permission::create([
                'name' => 'user.tasks.store'
            ]);
            Permission::create([
                'name' => 'user.tasks.update'
            ]);
            Permission::create([
                'name' => 'user.tasks.complete'
            ]);
            Permission::create([
                'name' => 'user.tasks.uncomplete'
            ]);
//        //
//        Gate::define('user.tasks.update', function ($user) {
//            return $user->hasPermission('user.tasks.update');
//        });
//
//        Gate::define('user.tasks.update', function ($user, $task) {
//            return $user->id === $task->user_id;
//        });
            Permission::create([
                'name' => 'user.tasks.destroy'
            ]);
        } catch (Exception $e) {

        }


        try {
            $tasks->givePermissionTo('user.tasks.index');
            $tasks->givePermissionTo('user.tasks.show');
            $tasks->givePermissionTo('user.tasks.store');
            $tasks->givePermissionTo('user.tasks.update');
            $tasks->givePermissionTo('user.tasks.complete');
            $tasks->givePermissionTo('user.tasks.uncomplete');
            $tasks->givePermissionTo('user.tasks.destroy');
        } catch(Exception $e) {

        }
    }
}

if (!function_exists('create_example_tags')) {
    function create_example_tags() {
        Tag::create([
            'name' => 'estudis',
            'description' => 'relacionat amb estudis',
            'color' => '#FFFFFF'
        ]);

        Tag::create([
            'name' => 'laravel',
            'description' => 'relacionat amb laravel',
            'color' => '#FFFFFF'
        ]);

        Tag::create([
            'name' => 'php',
            'description' => 'relacionat amb php',
            'color' => '#FFFFFF'
        ]);


    }
}

if (!function_exists('sample_users')) {
    function sample_users() {
        // Superadmin no cal -> soc jo mateix

        // Pepe Pringao -> No té cap permis ni cap rol

        try {
            factory(User::class)->create([
                'name' => 'Pepe Pringao',
                'email' => 'pepepringao@hotmail.com'
            ]);
        } catch (Exception $e) {}

        try {
            $bartsimpson = factory(User::class)->create([
                'name' => 'Bart Simpson',
                'email' => 'bartsimpson@simpson.com'
            ]);
        } catch (Exception $e) {}

        try {
            $bartsimpson->assignRole('Tasks');
        } catch (Exception $e) {}

        try {
            $homersimpson = factory(User::class)->create([
                'name' => 'Homer Simpson',
                'email' => 'homersimpson@simpson.com'
            ]);
        } catch (Exception $e) {}

        try {
            $homersimpson->assignRole('TaskManager');
        } catch (Exception $e) {}
    }
}

if (!function_exists('map_collection')) {
    function map_collection($collection) {
        return $collection->map(function ($item) {
           return $item->map();
        });


    }
}

if (!function_exists('logged_user')) {
    function logged_user() {
        return json_encode(optional(Auth::user())->map());
    }
}


//TODO Crear multiples usauris amb diferents rols
//TODO cOM GESTIONAR EL SUPERADMIN
