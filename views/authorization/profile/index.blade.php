@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-user"></i> @lang('Profile')
@endsection

<?php /** @var  Arcanesoft\Foundation\Authorization\Models\User  $user */ ?>

@section('content')
    <div class="row">
        <div class="col-md-6">
            {{-- ACCOUNT --}}
            <x-arc:form action="{{ route('admin::authorization.profile.account.update') }}" method="PUT">
                <x-arc:card>
                    <x-arc:card-header>@lang('Account')</x-arc:card-header>
                    <x-arc:card-body>
                        <div class="row g-3">
                            {{-- FIRST NAME --}}
                            <div class="col-12 col-xxl-6">
                                <x-arc:input-control
                                    type="text" name="first_name" label="First Name" grouped="true"
                                    :value="old('first_name', $user->first_name)" required/>
                            </div>

                            {{-- LAST NAME --}}
                            <div class="col-12 col-xxl-6">
                                <x-arc:input-control
                                    type="text" name="last_name" label="Last Name" grouped="true"
                                    :value="old('last_name', $user->last_name)" required/>
                            </div>

                            {{-- EMAIL --}}
                            <div class="col-12">
                                <x-arc:input-control
                                    type="email" name="email" label="Email" grouped="true"
                                    :value="old('email', $user->email)" required/>
                            </div>
                        </div>
                    </x-arc:card-body>
                    <x-arc:card-footer class="d-flex justify-content-end">
                        <x-arc:form-submit-button type="save"/>
                    </x-arc:card-footer>
                </x-arc:card>
            </x-arc:form>
        </div>
        <div class="col-md-6">
            {{-- PASSWORD --}}
            <x-arc:form action="{{ route('admin::authorization.profile.password.update') }}" method="PUT">
                <x-arc:card>
                    <x-arc:card-header>@lang('Edit Password')</x-arc:card-header>
                    <x-arc:card-body>
                        <div class="row g-3">
                            {{-- OLD PASSWORD --}}
                            <div class="col-12">
                                <x-arc:password-control
                                    name="current_password" label="Current Password" grouped="true" required/>
                            </div>

                            {{-- PASSWORD --}}
                            <div class="col-12">
                                <x-arc:password-control
                                    name="password" label="Password" grouped="true" required/>
                            </div>

                            {{-- PASSWORD CONFIRMATION --}}
                            <div class="col-12">
                                <x-arc:password-control
                                    name="password_confirmation" label="Confirm Password" grouped="true" required/>
                            </div>
                        </div>
                    </x-arc:card-body>
                    <x-arc:card-footer class="d-flex justify-content-end">
                        <x-arc:form-submit-button type="save"/>
                    </x-arc:card-footer>
                </x-arc:card>
            </x-arc:form>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
