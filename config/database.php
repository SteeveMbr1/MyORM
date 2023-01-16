<?php

return [
    'default' => 'SQLite',

    'SQLite' => [
        'driver'    => 'sqlite',
        'file'      => 'storage\store.db'
    ],

    'MySQL' => [
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'dbname'    => 'store',
        'username'  => 'root',
        'password'  => 'root'
    ]

];
