<ul class="timeline">
    @if ($entries->hasPages())
        <li class="time-label">
            <span class="label bg-aqua">
                {{ trans('foundation::pagination.pages', ['current' => $entries->currentPage(), 'last' => $entries->lastPage()]) }}
            </span>
        </li>
        @include('foundation::system.log-viewer._includes.timeline-pagination', compact('entries'))
    @endif

    @foreach($entries as $key => $entry)
    <li>
        <div class="timeline-icon level-{{ $entry->level }}" data-toggle="tooltip" data-original-title="{{ $entry->name() }}">
            {!! $entry->icon() !!}
        </div>
        <div class="timeline-item">
            <span class="time">
                <i class="fa fa-fw fa-clock-o"></i> {{ $entry->datetime->format('H:i:s') }}
            </span>
            <div class="timeline-header">
                <span class="label level-env">ENV: {{ $entry->env }}</span>
            </div>
            <div class="timeline-body">
                <p>{{ $entry->header }}</p>
                <button data-target="#log-entry-stack-{{ $key }}" data-toggle="collapse" aria-expanded="false" aria-controls="#log-entry-stack-{{ $key }}" class="btn btn-xs btn-default">
                    Toggle stack
                </button>
                <div id="log-entry-stack-{{ $key }}" class="collapse">
                    <pre>{{ $entry->stack }}</pre>
                </div>
            </div>
        </div>
    </li>
    @endforeach

    @if ($entries->hasPages())
        @include('foundation::system.log-viewer._includes.timeline-pagination', compact('entries'))
    @endif

    <li>
        <div class="timeline-icon bg-gray">
            <i class="fa fa-clock-o"></i>
        </div>
    </li>
</ul>
