@extends(arcanesoft\foundation()->template())

<?php
/**
 * @var  \Arcanesoft\Foundation\Auth\Models\Administrator                                    $administrator
 * @var  \Arcanesoft\Foundation\Auth\Models\Role[]|\Illuminate\Database\Eloquent\Collection  $roles
 */
?>

@section('page-title')
    <i class="fa fa-fw fa-user-secret"></i> @lang('Administrators') <small>@lang('Edit Administrator')</small>
@endsection

@section('content')
    {{ form()->open(['route' => ['admin::auth.administrators.update', $administrator], 'method' => 'PUT']) }}
        <div class="row g-4">
            <div class="col-lg-6 col-xl-5">
                <x-arc:card class="card card-borderless shadow-sm">
                    <x-arc:card-header>@lang('Administrator')</x-arc:card-header>
                    <x-arc:card-body>
                        <div class="row g-3">
                            {{-- FIRST NAME --}}
                            <div class="col-lg-6">
                                <label for="first_name" class="form-label font-weight-light text-uppercase text-muted">@lang('First Name')</label>
                                {{ form()->text('first_name', old('first_name', $administrator->first_name), ['class' => 'form-control'.$errors->first('first_name', ' is-invalid'), 'required']) }}
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- LAST NAME --}}
                            <div class="col-lg-6">
                                <label for="last_name" class="form-label font-weight-light text-uppercase text-muted">@lang('Last Name')</label>
                                {{ form()->text('last_name', old('last_name', $administrator->last_name), ['class' => 'form-control'.$errors->first('last_name', ' is-invalid'), 'required']) }}
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- EMAIL --}}
                            <div class="col-12">
                                <label for="email" class="form-label font-weight-light text-uppercase text-muted">@lang('Email')</label>
                                {{ form()->email('email', old('email', $administrator->email), ['class' => 'form-control'.$errors->first('email', ' is-invalid'), 'required']) }}
                                @error('email')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </x-arc:card-body>
                    <x-arc:card-footer class="d-flex justify-content-between">
                        <a href="{{ route('admin::auth.administrators.index') }}" class="btn btn-sm btn-light">
                            @lang('Cancel')
                        </a>
                        <button type="submit" class="btn btn-sm btn-primary">@lang('Save')</button>
                    </x-arc:card-footer>
                </x-arc:card>
            </div>
            <div class="col-lg-6 col-xl-7">
                <x-arc:card>
                    <x-arc:card-header>@lang('Roles')</x-arc:card-header>
                    <x-arc:card-table class="table table-borderless table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="font-weight-light text-uppercase text-muted">#</th>
                                <th class="font-weight-light text-uppercase text-muted">@lang('Name')</th>
                                <th class="font-weight-light text-uppercase text-muted">@lang('Description')</th>
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
