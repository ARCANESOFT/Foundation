<?php
/**
 * @see Arcanesoft\Foundation\Views\Components\Modals\TitleComponent
 *
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  Illuminate\Support\HtmlString          $slot
 */
$attributes = $attributes->class(['modal-title'])
?>
<h5 {{ $attributes }}>{{ $slot }}</h5>
