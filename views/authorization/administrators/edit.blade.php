@extends(arcanesoft\foundation()->template())

<?php
/**
 * @var  \Arcanesoft\Foundation\Authorization\Models\Administrator                                    $administrator
 * @var  \Arcanesoft\Foundation\Authorization\Models\Role[]|\Illuminate\Database\Eloquent\Collection  $roles
 */
?>

@section('page-title')
    <i class="fa fa-fw fa-user-secret"></i> @lang('Administrators') <small>@lang('Edit Administrator')</small>
@endsection

@section('content')
    {{ form()->open(['route' => ['admin::authorization.administrators.update', $administrator], 'method' => 'PUT']) }}
        <div class="row g-4">
            <div class="col-lg-6 col-xl-5">
                <x-arc:card>
                    <x-arc:card-header>@lang('Administrator')</x-arc:card-header>
                    <x-arc:card-body>
                        <div class="row g-3">
                            {{-- FIRST NAME --}}
                            <div class="col-12 col-xxl-6">
                                <x-arc:input-control
                                    type="text" name="first_name" :value="old('first_name', $administrator->first_name)"
                                    label="First Name" required/>
                            </div>

                            {{-- LAST NAME --}}
                            <div class="col-12 col-xxl-6">
                                <x-arc:input-control
                                    type="text" name="last_name" :value="old('last_name', $administrator->last_name)"
                                    label="Last Name" required/>
                            </div>

                            {{-- EMAIL --}}
                            <div class="col-12">
                                <x-arc:input-control
                                    type="email" name="email" :value="old('email', $administrator->email)"
                                    label="Email" required/>
                            </div>
                        </div>
                    </x-arc:card-body>
                    <x-arc:card-footer class="d-flex justify-content-between">
                        <x-arc:form-cancel-button to="{{ route('admin::authorization.administrators.show', [$administrator]) }}"/>
                        <x-arc:form-submit-button type="save"/>
                    </x-arc:card-footer>
                </x-arc:card>
            </div>
            <div class="col-lg-6 col-xl-7">
                <x-arc:card>
                    <x-arc:card-header>@lang('Roles')</x-arc:card-header>
                    <x-arc:card-table class="table table-borderless table-hover mb-0">
                        <thead>
                            <tr>
                                <x-arc:table-th label="#"/>
                                <x-arc:table-th label="Name"/>
                                <x-arc:table-th label="Description"/>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>
                                    {{ form()->checkbox('roles[]', $role->getRouteKey(), in_array($role->getRouteKey(), old('roles', $administrator->roles->pluck($role->getRouteKeyName())->toArray()))) }}
                                </td>
                                <td class="small">{{ $role->name }}</td>
                                <td class="small">{{ $role->description }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </x-arc:card-table>
                </x-arc:card>
            </div>
        </div>
    {{ form()->close() }}
@endsection
