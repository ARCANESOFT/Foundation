<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Forms\HelpTextComponent
 *
 * @var  string       $id
 * @var  string|null  $text
 */
$hasText = ! is_null($text);
?>
@if ($hasText)
<div id="{{ $id.'-help' }}" class="form-text">{{ __($text) }}</div>
@endif
