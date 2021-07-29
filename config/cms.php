<?php

return [

    'database' => [
        'connection' => env('DB_CONNECTION', 'mysql'),

        'prefix'     => 'cms_',

        'tables'     => [
            'categories'     => 'categories',
            'categorizables' => 'categorizables',
            'languages'      => 'languages',
        ],

        'models' => [
            'category' => Arcanesoft\Foundation\Cms\Models\Category::class,
            'language' => Arcanesoft\Foundation\Cms\Models\Language::class,
        ],
    ],

];
