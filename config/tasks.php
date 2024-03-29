<?php
return [
    'manager_email' => env('TASKS_MANAGER_EMAIL', 'tasksmanager@tasques.cat'),
    //Salts hash id's
    'tasks_salt' => env('TASKS_SALT'),

    //admin user
    'admin_user' => [
        'name' => env('PRIMARY_USER_NAME', 'Mimoun Haddou'),
        'email' => env('PRIMARY_USER_EMAIL', 'mimounhaddou@iesebre.com'),
        'mobile' => env('PRIMARY_USER_MOBILE', '0034000000000'),
        'password' => env('PRIMARY_USER_PASSWORD', 'secret')
    ],

    //acacha user
    'acacha_user' => [
        'name' => env('ACACHA_USER_NAME', 'Sergi Tur Badenas'),
        'email' => env('ACACHA_USER_EMAIL', 'sergiturbadenas@gmail.com'),
        'mobile' => env('ACACHA_USER_MOBILE', '0034000000001'),
        'password' => env('ACACHA_USER_PASSWORD', 'secret')
    ]
];
