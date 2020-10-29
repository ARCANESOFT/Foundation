<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Forms\Buttons\Submit
 */
?>
<button {{ $attributes->merge(['class' => $actionClass(), 'type' => 'submit']) }}>
    <i class="{{ $actionIcon() }}"></i> {{ $actionName() }}
</button>
