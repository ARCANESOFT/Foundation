<?php /** @var  \Illuminate\Support\Collection  $foundationMetrics */ ?>

@unless($foundationMetrics->isEmpty())
    <div id="metric-cards" class="metric-cards row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 mb-3">
        @foreach($foundationMetrics as $metric)
            <div class="col">{{ $metric }}</div>
        @endforeach
    </div>
@endunless

@stack('metrics')
