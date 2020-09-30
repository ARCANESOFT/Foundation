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
