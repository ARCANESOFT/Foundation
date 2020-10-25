<?php

return [

    /* -----------------------------------------------------------------
     |  Blade components
     | -----------------------------------------------------------------
     */

    'components' => [

        // Buttons
        'arc:button-close'     => Arcanesoft\Foundation\Views\Components\Buttons\Close::class,

        // Form
        'arc:form'             => Arcanesoft\Foundation\Views\Components\Forms\Form::class,

        // Form Inputs
        'arc:password'         => Arcanesoft\Foundation\Views\Components\Forms\Inputs\Password::class,

        // Form Controls
        'arc:checkbox-control' => Arcanesoft\Foundation\Views\Components\Forms\Controls\Checkbox::class,
        'arc:input-control'    => Arcanesoft\Foundation\Views\Components\Forms\Controls\Input::class,
        'arc:password-control' => Arcanesoft\Foundation\Views\Components\Forms\Controls\Password::class,

        // Table
        'arc:table-th'         => Arcanesoft\Foundation\Views\Components\Table\Th::class,

        // Datatable
        'arc:datatable-action'     => Arcanesoft\Foundation\Views\Components\Datatable\Action::class,
        'arc:datatable-pagination' => Arcanesoft\Foundation\Views\Components\Datatable\Pagination::class,

        // Modal
        'arc:modal'            => Arcanesoft\Foundation\Views\Components\Modals\Modal::class,
        'arc:modal-header'     => Arcanesoft\Foundation\Views\Components\Modals\Header::class,
        'arc:modal-title'      => Arcanesoft\Foundation\Views\Components\Modals\Title::class,
        'arc:modal-close'      => Arcanesoft\Foundation\Views\Components\Modals\Close::class,
        'arc:modal-body'       => Arcanesoft\Foundation\Views\Components\Modals\Body::class,
        'arc:modal-footer'     => Arcanesoft\Foundation\Views\Components\Modals\Footer::class,

        'arc:modal-action'        => Arcanesoft\Foundation\Views\Components\Modals\ActionModal::class,
        'arc:modal-action-button' => Arcanesoft\Foundation\Views\Components\Modals\Buttons\Action::class,
        'arc:modal-cancel-button' => Arcanesoft\Foundation\Views\Components\Modals\Buttons\Cancel::class,

        // Support
        'arc:card'             => Arcanesoft\Foundation\Views\Components\Cards\Card::class,
        'arc:card-header'      => Arcanesoft\Foundation\Views\Components\Cards\Header::class,
        'arc:card-body'        => Arcanesoft\Foundation\Views\Components\Cards\Body::class,
        'arc:card-table'       => Arcanesoft\Foundation\Views\Components\Cards\Table::class,
        'arc:card-footer'      => Arcanesoft\Foundation\Views\Components\Cards\Footer::class,

        // Pagination
        'arc:pagination-pages' => Arcanesoft\Foundation\Views\Components\Pagination\Pages::class

    ],

];
