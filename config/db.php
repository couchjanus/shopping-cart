<?php
/**
 * Данные для подключения к БД
 */
// return [
//     'database' => [
//         'name' => 'mydb',
//         'username' => 'dev',
//         'password' => 'ghbdtn',
//         'connection' => 'pgsql:host=localhost',
//         'options' => [
//             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
//         ]
//     ]
// ];

return [
    'database' => [
        'name' => 'mydb',
        'username' => 'dev',
        'password' => 'ghbdtn',
        'connection' => 'mysql:host=localhost',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];
