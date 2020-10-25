@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fa fa-fw fa-users"></i> @lang('Users') <small>@lang('New User')</small>
@endsection

@section('content')
    {{ form()->open(['route' => 'admin::auth.users.store', 'method' => 'POST']) }}
        <div class="row">
            <div class="col-md-6">
                <x-arc:card>
                    <x-arc:card-header>@lang('User')</x-arc:card-header>
                    <x-arc:card-body>
                        <div class="row g-3">
                            {{-- FIRST NAME --}}
                            <div class="col-12 col-xxl-6">
                                <x-arc:input-control type="text" name="first_name" :value="old('first_name')"
                                                     label="First Name" required/>
                            </div>

                            {{-- LAST NAME --}}
                            <div class="col-12 col-xxl-6">
                                <x-arc:input-control type="text" name="last_name" :value="old('last_name')"
                                                     label="Last Name" required/>
                            </div>

                            {{-- EMAIL --}}
                            <div class="col-12">
                                <x-arc:input-control type="email" name="email" :value="old('email')"
                                                     label="Email" required/>
                            </div>

                            {{-- PASSWORD --}}
                            <div class="col-12 col-xxl-6">
                                <x-arc:password-control name="password" label="Password"/>
                            </div>

                            {{-- PASSWORD CONFIRMATION --}}
                            <div class="col-12 col-xxl-6">
                                <x-arc:password-control name="password_confirmation" label="Confirm Password"/>
                            </div>
                        </div>
                    </x-arc:card-body>
                    <x-arc:card-footer class="d-flex justify-content-between">
                        <a href="{{ route('admin::auth.users.index') }}" class="btn btn-sm btn-light">@lang('Cancel')</a>
                        <button type="submit" class="btn btn-sm btn-primary">@lang('Save')</button>
                    </x-arc:card-footer>
                </x-arc:card>
            </div>
        </div>
    {{ form()->close() }}
@endsection
