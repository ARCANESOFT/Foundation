<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Forms\Inputs\CheckboxComponent
 *
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  string                                 $name
 * @var  string                                 $id
 * @var  mixed|null                             $value
 * @var  bool                                   $checked
 */
$attributes = $attributes
    ->merge([
        'type'    => 'checkbox',
        'name'    => $name,
        'id'      => $id,
        'value'   => $value,
        'checked' => $checked,
    ])
;
?>
<input {{ $attributes }}/>
