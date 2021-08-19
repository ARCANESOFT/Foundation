<?php
/**
 * @see Arcanesoft\Foundation\Views\Components\Modals\HeaderComponent
 *
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  Illuminate\Support\HtmlString          $slot
 */
?>
<div {{ $attributes->class(['modal-header']) }}>
    {{ $slot }}
    <x-arc:modal-close/>
</div>
