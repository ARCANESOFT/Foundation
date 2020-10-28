<?php

return [

    /* -----------------------------------------------------------------
     |  Settings
     | -----------------------------------------------------------------
     */

    'prefix' => 'arc:',

    /* -----------------------------------------------------------------
     |  Blade components
     | -----------------------------------------------------------------
     */

    'components' => [

        // Buttons
        'button-close'     => Arcanesoft\Foundation\Views\Components\Buttons\Close::class,

        // Form
        'form'             => Arcanesoft\Foundation\Views\Components\Forms\Form::class,
        'form-error'       => Arcanesoft\Foundation\Views\Components\Forms\Error::class,
        'form-label'       => Arcanesoft\Foundation\Views\Components\Forms\Label::class,

        // Form Inputs
        'password'         => Arcanesoft\Foundation\Views\Components\Forms\Inputs\Password::class,

        // Form Controls
        'checkbox-control' => Arcanesoft\Foundation\Views\Components\Forms\Controls\Checkbox::class,
        'input-control'    => Arcanesoft\Foundation\Views\Components\Forms\Controls\Input::class,
        'select-control'   => Arcanesoft\Foundation\Views\Components\Forms\Controls\Select::class,
        'textarea-control' => Arcanesoft\Foundation\Views\Components\Forms\Controls\Textarea::class,
        'password-control' => Arcanesoft\Foundation\Views\Components\Forms\Controls\Password::class,
        'vue-control'      => Arcanesoft\Foundation\Views\Components\Forms\Controls\Vue::class,

        // Form Actions
        'form-submit-button' => Arcanesoft\Foundation\Views\Components\Forms\Buttons\Submit::class,
        'form-cancel-button' => Arcanesoft\Foundation\Views\Components\Forms\Buttons\Cancel::class,

        // Table
        'table-th'         => Arcanesoft\Foundation\Views\Components\Table\Th::class,

        // Datatable
        'datatable-action'     => Arcanesoft\Foundation\Views\Components\Datatable\Action::class,
        'datatable-pagination' => Arcanesoft\Foundation\Views\Components\Datatable\Pagination::class,

        // Modal
        'modal'            => Arcanesoft\Foundation\Views\Components\Modals\Modal::class,
        'modal-header'     => Arcanesoft\Foundation\Views\Components\Modals\Header::class,
        'modal-title'      => Arcanesoft\Foundation\Views\Components\Modals\Title::class,
        'modal-close'      => Arcanesoft\Foundation\Views\Components\Modals\Close::class,
        'modal-body'       => Arcanesoft\Foundation\Views\Components\Modals\Body::class,
        'modal-footer'     => Arcanesoft\Foundation\Views\Components\Modals\Footer::class,

        'modal-action'        => Arcanesoft\Foundation\Views\Components\Modals\ActionModal::class,
        'modal-action-button' => Arcanesoft\Foundation\Views\Components\Modals\Buttons\Action::class,
        'modal-cancel-button' => Arcanesoft\Foundation\Views\Components\Modals\Buttons\Cancel::class,

        // Card
        'card'             => Arcanesoft\Foundation\Views\Components\Cards\Card::class,
        'card-header'      => Arcanesoft\Foundation\Views\Components\Cards\Header::class,
        'card-body'        => Arcanesoft\Foundation\Views\Components\Cards\Body::class,
        'card-table'       => Arcanesoft\Foundation\Views\Components\Cards\Table::class,
        'card-footer'      => Arcanesoft\Foundation\Views\Components\Cards\Footer::class,

        // Pagination
        'pagination-pages' => Arcanesoft\Foundation\Views\Components\Pagination\Pages::class,

        // Support
        'badge-active'     => Arcanesoft\Foundation\Views\Components\Support\Badges\Active::class,
        'badge-count'      => Arcanesoft\Foundation\Views\Components\Support\Badges\Count::class,

    ],

];
