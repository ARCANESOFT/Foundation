<?php
/**
 * @see Arcanesoft\Foundation\Views\Components\Modals\ModalComponent
 *
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  Illuminate\Support\HtmlString          $slot
 */
$attributes = $attributes
    ->class(['modal', 'fade'])
    ->merge([
        'tabindex' => '-1',
        'aria-hidden' => 'true',
    ])
;
?>
<div {{ $attributes }}>
    <div class="modal-dialog">
        <div class="modal-content">{{ $slot }}</div>
    </div>
</div>
