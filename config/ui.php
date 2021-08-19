<?php

return [

    /* -----------------------------------------------------------------
     |  Actions
     | -----------------------------------------------------------------
     */

    'actions' => [
        'add'  => [
            'text'  => 'Add',
            'icon'  => 'fa fa-fw fa-plus',
            'class' => 'btn btn-primary',
        ],

        'create' => [
            'text'  => 'Create',
            'icon'  => 'fa fa-fw fa-plus',
            'class' => 'btn btn-primary',
        ],

        'show' => [
            'text'  => 'Show',
            'icon'  => 'fa fa-fw fa-search',
            'class' => 'btn btn-info',
        ],

        'edit' => [
            'text'  => 'Edit',
            'icon'  => 'far fa-fw fa-edit',
            'class' => 'btn btn-warning',
        ],

        'update' => [
            'text'  => 'Update',
            'icon'  => 'far fa-fw fa-edit',
            'class' => 'btn btn-warning',
        ],

        'activate' => [
            'text'  => 'Activate',
            'icon'  => 'fa fa-fw fa-check',
            'class' => 'btn btn-success',
        ],

        'deactivate' => [
            'text'  => 'Deactivate',
            'icon'  => 'fa fa-fw fa-ban',
            'class' => 'btn btn-secondary',
        ],

        'delete' => [
            'text'  => 'Delete',
            'icon'  => 'far fa-fw fa-trash-alt',
            'class' => 'btn btn-danger',
        ],

        'restore' => [
            'text'  => 'Restore',
            'icon'  => 'fa fa-fw fa-trash-restore-alt',
            'class' => 'btn btn-primary',
        ],

        'cancel' => [
            'text'  => 'Cancel',
            'icon'  => null,
            'class' => 'btn btn-light',
        ],

        'disabled' => [
            'class'      => 'btn btn-outline-secondary',
            'attributes' => ['disabled']
        ],
    ],

];
