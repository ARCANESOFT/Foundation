@section('header')
    <i class="fa fa-fw fa-dashboard"></i> Dashboard
@endsection

@section('content')
    @foreach(config('arcanesoft.foundation.dashboards') as $view)
        @if (view()->exists($view)) @include($view) @endif
    @endforeach
@endsection

@section('scripts')

@endsection
