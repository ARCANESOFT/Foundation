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

        // Layout
        'layout'            => Arcanesoft\Foundation\Views\Components\LayoutComponent::class,

        // Buttons
        'button-close'      => Arcanesoft\Foundation\Views\Components\Buttons\CloseComponent::class,
        'button-action'     => Arcanesoft\Foundation\Views\Components\Buttons\ActionComponent::class,

        // Form
        'form'              => Arcanesoft\Foundation\Views\Components\Forms\FormComponent::class,
        'form-error'        => Arcanesoft\Foundation\Views\Components\Forms\ErrorComponent::class,
        'form-label'        => Arcanesoft\Foundation\Views\Components\Forms\LabelComponent::class,
        'form-help-text'    => Arcanesoft\Foundation\Views\Components\Forms\HelpTextComponent::class,

        // Form Inputs
        'input'             => Arcanesoft\Foundation\Views\Components\Forms\Inputs\InputComponent::class,
        'checkbox'          => Arcanesoft\Foundation\Views\Components\Forms\Inputs\CheckboxComponent::class,
        'password'          => Arcanesoft\Foundation\Views\Components\Forms\Inputs\PasswordComponent::class,

        // Form Controls
        'checkbox-control'  => Arcanesoft\Foundation\Views\Components\Forms\Controls\CheckboxComponent::class,
        'input-control'     => Arcanesoft\Foundation\Views\Components\Forms\Controls\InputComponent::class,
        'select-control'    => Arcanesoft\Foundation\Views\Components\Forms\Controls\SelectComponent::class,
        'textarea-control'  => Arcanesoft\Foundation\Views\Components\Forms\Controls\TextareaComponent::class,
        'password-control'  => Arcanesoft\Foundation\Views\Components\Forms\Controls\PasswordComponent::class,
        'vue-control'       => Arcanesoft\Foundation\Views\Components\Forms\Controls\VueComponent::class,

        // Form Actions
        'form-submit-button' => Arcanesoft\Foundation\Views\Components\Forms\Buttons\SubmitComponent::class,
        'form-cancel-button' => Arcanesoft\Foundation\Views\Components\Forms\Buttons\CancelComponent::class,

        // Table
        'table-th'          => Arcanesoft\Foundation\Views\Components\Table\ThComponent::class,
        'table-action'      => Arcanesoft\Foundation\Views\Components\Table\ActionComponent::class,

        // Modal
        'modal'             => Arcanesoft\Foundation\Views\Components\Modals\ModalComponent::class,
        'modal-header'      => Arcanesoft\Foundation\Views\Components\Modals\HeaderComponent::class,
        'modal-title'       => Arcanesoft\Foundation\Views\Components\Modals\TitleComponent::class,
        'modal-close'       => Arcanesoft\Foundation\Views\Components\Modals\CloseComponent::class,
        'modal-body'        => Arcanesoft\Foundation\Views\Components\Modals\BodyComponent::class,
        'modal-footer'      => Arcanesoft\Foundation\Views\Components\Modals\FooterComponent::class,

        'modal-action'        => Arcanesoft\Foundation\Views\Components\Modals\ActionModalComponent::class,
        'modal-action-button' => Arcanesoft\Foundation\Views\Components\Modals\Buttons\ActionComponent::class,
        'modal-cancel-button' => Arcanesoft\Foundation\Views\Components\Modals\Buttons\CancelComponent::class,

        // Card
        'card'              => Arcanesoft\Foundation\Views\Components\Cards\CardComponent::class,
        'card-header'       => Arcanesoft\Foundation\Views\Components\Cards\HeaderComponent::class,
        'card-body'         => Arcanesoft\Foundation\Views\Components\Cards\BodyComponent::class,
        'card-table'        => Arcanesoft\Foundation\Views\Components\Cards\TableComponent::class,
        'card-footer'       => Arcanesoft\Foundation\Views\Components\Cards\FooterComponent::class,

        // Pagination
        'pagination-pages'  => Arcanesoft\Foundation\Views\Components\Pagination\PagesComponent::class,

        // Support
        'badge'             => Arcanesoft\Foundation\Views\Components\Support\Badges\BadgeComponent::class,
        'badge-active'      => Arcanesoft\Foundation\Views\Components\Support\Badges\ActiveComponent::class,
        'badge-count'       => Arcanesoft\Foundation\Views\Components\Support\Badges\CountComponent::class,
        'badge-locked'      => Arcanesoft\Foundation\Views\Components\Support\Badges\LockedComponent::class,

        // CMS
        'localized-content'      => Arcanesoft\Foundation\Views\Components\Cms\LocalizedContentComponent::class,
        'localized-content-pane' => Arcanesoft\Foundation\Views\Components\Cms\LocalizedContentPaneComponent::class,

    ],

];
