<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Forms\Inputs\PasswordComponent
 *
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  string                                 $name
 * @var  string                                 $id
 */
$attributes = $attributes
    ->except(['value'])
    ->merge([
        'type' => 'password',
        'name' => $name,
        'id'   => $id,
    ])
    ->class([
        'form-control',
    ])
;
?>
<input {{ $attributes }}/>
