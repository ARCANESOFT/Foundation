<?php
/**
 * @var  string                                 $name
 * @var  string                                 $id
 * @var  mixed|null                             $value
 * @var  bool                                   $checked
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
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
