<?php
/**
 * @var  \Illuminate\View\ComponentAttributeBag  $attributes
 * @var  string                                  $action
 * @var  string                                  $type
 * @var  array                                   $actionName
 * @var  array                                   $actionAttributes
 */
$attributes = $attributes->merge([
    'class'       => 'btn btn-sm btn-light',
    'data-toggle' => 'tooltip',
    'title'       => $actionName(),
]);
?>

@if ($allowed)
    @if($actionTag() === Arcanesoft\Foundation\Views\Components\Datatable\Action::ACTION_TAG_BUTTON)
        <?php
            $isDangerAction = $type === Arcanesoft\Foundation\Views\Components\Datatable\Action::ACTION_TYPE_DELETE;
        ?>
        <button {{ $attributes->merge(['onclick' => $action, 'class' => $isDangerAction ? 'text-danger' : '']) }}>
            <i class="{{ $actionIcon }}"></i>
        </button>
    @else
        <a {{ $attributes->merge(['href' => $action]) }}>
            <i class="{{ $actionIcon }}"></i>
        </a>
    @endif
@else
    <button {{ $attributes->merge(['class' => 'disabled', 'tabindex' => '-1', 'aria-disabled' => 'true']) }}>
        <i class="{{ $actionIcon }}"></i>
    </button>
@endif
