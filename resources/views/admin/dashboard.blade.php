@section('header')
    <i class="fa fa-fw fa-dashboard"></i> Dashboard
@endsection

@section('content')
    @foreach(config('arcanesoft.foundation.dashboards', []) as $view)
        @includeIf($view)
    @endforeach
@endsection

@section('scripts')
@endsection
