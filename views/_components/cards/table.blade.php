<div class="table-responsive">
    <table {{ $attributes->merge(['class' => 'table table-borderless mb-0']) }}>
        {{ $slot }}
    </table>
</div>
