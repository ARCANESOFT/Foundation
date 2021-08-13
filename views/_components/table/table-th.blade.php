<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Table\ThComponent
 *
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  Illuminate\Support\HtmlString          $slot
 * @var  string                                 $label
 */
?>
<th {{ $attributes->class(['fw-light text-uppercase text-muted']) }}>{{ $label ?: $slot }}</th>
