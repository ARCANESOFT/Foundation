@section('header')
    <i class="fa fa-fw fa-dashboard"></i> Dashboard
@endsection

@section('content')
    @if (view()->exists('auth::foundation._includes.dashboard'))
        @include('auth::foundation._includes.dashboard')
    @endif
@endsection

@section('scripts')

@endsection
