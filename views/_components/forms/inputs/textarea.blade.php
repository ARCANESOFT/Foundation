<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Forms\Inputs\TextareaComponent
 *
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  string                                 $name
 * @var  string                                 $id
 * @var  string                                 $rows
 */
$attributes = $attributes
    ->merge([
        'name' => $name,
        'id'   => $id,
        'rows' => $rows,
    ])
    ->class([
        'form-control',
    ])
;
?>
<textarea {{ $attributes }}>{{ old($name, $slot) }}</textarea>
