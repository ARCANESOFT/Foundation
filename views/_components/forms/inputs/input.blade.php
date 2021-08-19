<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Forms\Inputs\InputComponent
 *
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  Illuminate\Support\ViewErrorBag        $errors
 * @var  string                                 $type
 * @var  string                                 $name
 * @var  string                                 $id
 * @var  mixed                                  $value
 */
$attributes = $attributes
    ->merge([
        'type'  => $type,
        'name'  => $name,
        'id'    => $id,
        'value' => old($name, $value),
    ])
    ->class([
        'form-control',
        'is-invalid' => $errors->has($name),
    ])
;
?>
<input {{ $attributes }}/>
