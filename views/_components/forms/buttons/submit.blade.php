<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Forms\Buttons\SubmitComponent
 */
?>
<button {{ $attributes->merge(['class' => $actionClass(), 'type' => 'submit']) }}>
    <i class="{{ $actionIcon() }}"></i> {{ $actionName() }}
</button>
