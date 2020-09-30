<span {{ $attributes->merge(['class' => 'd-inline-block badge border border-secondary text-secondary']) }}>
    @lang('Page :current of :last', ['current' => $paginator->currentPage(), 'last' => $paginator->lastPage()])
</span>
