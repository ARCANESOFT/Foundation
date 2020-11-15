@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fa fa-fw fa-users"></i> @lang('Users') <small>@lang('New User')</small>
@endsection

@section('content')
    <x-arc:form action="{{ route('admin::authorization.users.store') }}" method="POST">
        <div class="row">
            <div class="col-lg-6">
                <x-arc:card>
                    <x-arc:card-header>@lang('User')</x-arc:card-header>
                    <x-arc:card-body>
                        <div class="row g-3">
                            {{-- FIRST NAME --}}
                            <div class="col-12 col-xxl-6">
                                <x-arc:input-control
                                    type="text" name="first_name" :value="old('first_name')" label="First Name"
                                    grouped="true" required/>
                            </div>

                            {{-- LAST NAME --}}
                            <div class="col-12 col-xxl-6">
                                <x-arc:input-control
                                    type="text" name="last_name" :value="old('last_name')" label="Last Name"
                                    required grouped="true"/>
                            </div>

                            {{-- EMAIL --}}
                            <div class="col-12">
                                <x-arc:input-control
                                    type="email" name="email" :value="old('email')" label="Email"
                                    required grouped="true"/>
                            </div>

                            {{-- PASSWORD --}}
                            <div class="col-12 col-xxl-6">
                                <x-arc:password-control name="password" label="Password"
                                                        grouped="true"/>
                            </div>

                            {{-- PASSWORD CONFIRMATION --}}
                            <div class="col-12 col-xxl-6">
                                <x-arc:password-control name="password_confirmation" label="Confirm Password"
                                                        grouped="true"/>
                            </div>
                        </div>
                    </x-arc:card-body>
                    <x-arc:card-footer class="d-flex justify-content-between">
                        <x-arc:form-cancel-button to="{{ route('admin::authorization.users.index') }}"/>
                        <x-arc:form-submit-button type="save"/>
                    </x-arc:card-footer>
                </x-arc:card>
            </div>
        </div>
    </x-arc:form>
@endsection
