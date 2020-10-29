@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fa fa-fw fa-users"></i> @lang('Users') <small>@lang('Edit User')</small>
@endsection

<?php /** @var  App\Models\User|mixed  $user */ ?>

@section('content')
    <x-arc:form action="{{ route('admin::authorization.users.update', [$user]) }}" method="PUT">
        <div class="row">
            <div class="col-md-6">
                <x-arc:card>
                    <x-arc:card-header>@lang('User')</x-arc:card-header>
                    <x-arc:card-body>
                        <div class="row g-3">
                            {{-- FIRST NAME --}}
                            <div class="col-12 col-xxl-6">
                                <x-arc:input-control
                                    type="text" name="first_name" :value="old('first_name', $user->first_name)"
                                    label="First Name" required/>
                            </div>

                            {{-- LAST NAME --}}
                            <div class="col-12 col-xxl-6">
                                <x-arc:input-control
                                    type="text" name="last_name" :value="old('last_name', $user->last_name)"
                                    label="First Name" required/>
                            </div>

                            {{-- EMAIL --}}
                            <div class="col-12">
                                <x-arc:input-control
                                    type="email" name="email" :value="old('email', $user->email)"
                                    label="Email" required/>
                            </div>
                        </div>
                    </x-arc:card-body>
                    <x-arc:card-footer class="d-flex justify-content-between">
                        <x-arc:form-cancel-button to="{{ route('admin::authorization.users.show', [$user]) }}"/>
                        <x-arc:form-submit-button type="save"/>
                    </x-arc:card-footer>
                </x-arc:card>
            </div>
        </div>
    </x-arc:form>
@endsection
