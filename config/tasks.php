<?php
/**
 * Created by PhpStorm.
 * User: mimoun
 * Date: 18/01/19
 * Time: 15:56
 */
return [
    'manager_email' => env('TASKS_MANAGER_EMAIL', 'tasksmanager@tasques.cat'),
    //Salts hash id's
    'tasks_salt' => env('TASKS_SALT'),

    //admin user
    'admin_user' => [
        'name' => env('PRIMARY_USER_NAME', 'Mimoun Haddou'),
        'email' => env('PRIMARY_USER_EMAIL', 'mimounhaddou@iesebre.com'),
        'mobile' => env('PRIMARY_USER_MOBILE', '0034631624698'),
        'password' => env('PRIMARY_USER_PASSWORD', '7c4a8d09ca3762af61e59520943dc26494f8941b')
    ],

    //acacha user
    'acacha_user' => [
        'name' => env('ACACHA_USER_NAME', 'Sergi Tur Badenas'),
        'email' => env('ACACHA_USER_EMAIL', 'sergiturbadenas@gmail.com'),
        'mobile' => env('ACACHA_USER_MOBILE', '000000000000'),
        'password' => env('ACACHA_USER_PASSWORD', '7c4a8d09ca3762af61e59520943dc26494f8941b')
    ]
];
