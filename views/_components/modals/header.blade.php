<div {{ $attributes->merge(['class' => 'modal-header']) }}>
    {{ $slot }}
    <x-arc:modal-close/>
</div>
