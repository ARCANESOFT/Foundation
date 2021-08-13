<?php
/**
 * @see Arcanesoft\Foundation\Views\Components\Modals\ActionModalComponent
 *
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  Illuminate\Support\HtmlString          $slot
 */
?>
<x-arc:modal id="{{ $id }}-modal" aria-labelledby="{{ $id }}-modal-title" data-backdrop="static">
    <x-arc:form action="{{ $action }}" method="{{ $method }}" id="{{ $id }}-form">
        <x-arc:modal-header>
            <x-arc:modal-title id="{{ $id }}-modal-title">{{ $title }}</x-arc:modal-title>
        </x-arc:modal-header>
        <x-arc:modal-body>
            {{ $slot->isNotEmpty() ? $slot : $body }}
        </x-arc:modal-body>
        <x-arc:modal-footer class="justify-content-between">
            <x-arc:modal-cancel-button/>
            <x-arc:modal-action-button type="{{ $type }}"/>
        </x-arc:modal-footer>
    </x-arc:form>
</x-arc:modal>
