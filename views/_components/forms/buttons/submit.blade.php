<button {{ $attributes->merge(['class' => $actionClass(), 'type' => 'submit']) }}>
    <i class="{{ $actionIcon() }}"></i> {{ $actionName() }}
</button>
