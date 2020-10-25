@foreach($foundationNotifications as $notification)
    <div class="alert alert-with-icon alert-{{ $notification['type'] }} alert-dismissible" role="alert">
        @if($notification['icon'])
        <div class="alert-icon">
            <i class="fas fa-fw fa-1x {{ $notification['icon'] }}"></i>
        </div>
        @endif
        <div class="alert-content py-2 px-3">
            <h5>{{ $notification['message'] }}</h5>
            @if($notification['content'])
            <p class="mb-0">{{ $notification['content'] }}</p>
            @endif
        </div>
        <x-arc:button-close data-dismiss="alert"/>
    </div>
@endforeach

@stack('alerts')
