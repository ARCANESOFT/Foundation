<?php
/**
 * @see Arcanesoft\Foundation\Views\Components\Modals\Buttons\ActionComponent
 *
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 */
?>
<button {{ $attributes->class($actionClass())->merge(['type' => 'submit']) }}>
    <i class="{{ $actionIcon() }}"></i> {{ $actionName() }}
</button>
