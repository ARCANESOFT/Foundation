<?php
/**
 * @var  string       $id
 * @var  string|null  $text
 */
$hasText = ! is_null($text);
?>
@if ($hasText)
<div id="{{ $id.'-help' }}" class="form-text">{{ __($text) }}</div>
@endif
