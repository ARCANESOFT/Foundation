<?php

return [

    'actions' => [
        'icons' => [
            'show'       => 'far fa-fw fa-eye',
            'edit'       => 'far fa-fw fa-edit',
            'activate'   => 'fas fa-fw fa-check',
            'deactivate' => 'fas fa-fw fa-ban',
            'restore'    => 'fas fa-fw fa-recycle',
            'delete'     => 'far fa-fw fa-trash-alt',
        ],
    ],

    'per-page' => [
        'default'  => 25,

        'options'  => [
            [
                'value' => 25,
                'label' => '25',
            ],
            [
                'value' => 50,
                'label' => '50',
            ],
            [
                'value' => 75,
                'label' => '75',
            ],
            [
                'value' => 100,
                'label' => '100',
            ],
        ]
    ],

];
