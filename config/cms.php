<?php

return [

    'database' => [
        'connection' => env('DB_CONNECTION', 'mysql'),

        'prefix'     => 'cms_',

        'tables'     => [
            'categories'     => 'categories',
            'categorizables' => 'categorizables',
        ],

        'models' => [
            'category' => Arcanesoft\Foundation\Cms\Models\Category::class,
        ],
    ],

];
