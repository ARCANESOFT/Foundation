<li>
    <div class="timeline-item">
        <div class="timeline-body text-center">
            {!! $entries->appends(compact('query'))->render('foundation::admin._partials.pagination.small') !!}
        </div>
    </div>
</li>
