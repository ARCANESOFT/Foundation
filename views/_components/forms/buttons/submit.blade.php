<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Forms\Buttons\SubmitComponent
 *
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  Closure                                $actionClass
 * @var  Closure                                $actionIcon
 * @var  Closure                                $actionName
 */
$attributes = $attributes
    ->merge([
        'type' => 'submit',
    ])
    ->class($actionClass())
;
?>
<button {{ $attributes }}>
    <i class="{{ $actionIcon() }}"></i> {{ $actionName() }}
</button>
