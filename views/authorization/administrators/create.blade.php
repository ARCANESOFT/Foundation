@extends(arcanesoft\foundation()->template())

<?php
/**
 * @var  \Arcanesoft\Foundation\Auth\Models\Role[]|\Illuminate\Database\Eloquent\Collection  $roles
 */
?>

@section('page-title')
    <i class="fa fa-fw fa-user-secret"></i> @lang('Administrators') <small>@lang('New Administrator')</small>
@endsection

@section('content')
    {{ form()->open(['route' => 'admin::auth.administrators.store', 'method' => 'POST']) }}
        <div class="row g-4">
            <div class="col-lg-6 col-xl-5">
                <div class="card card-borderless shadow-sm">
                    <div class="card-header">@lang('Administrator')</div>
                    <div class="card-body">
                        <div class="row g-3">
                            {{-- FIRST NAME --}}
                            <div class="col-lg-6">
                                <label for="first_name" class="form-label font-weight-light text-uppercase text-muted">@lang('First Name')</label>
                                {{ form()->text('first_name', old('first_name'), ['class' => 'form-control'.$errors->first('first_name', ' is-invalid'), 'required']) }}
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- LAST NAME --}}
                            <div class="col-lg-6">
                                <label for="last_name" class="form-label font-weight-light text-uppercase text-muted">@lang('Last Name')</label>
                                {{ form()->text('last_name', old('last_name'), ['class' => 'form-control'.$errors->first('last_name', ' is-invalid'), 'required']) }}
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- EMAIL --}}
                            <div class="col-12">
                                <label for="email" class="form-label font-weight-light text-uppercase text-muted">@lang('Email')</label>
                                {{ form()->email('email', old('email'), ['class' => 'form-control'.$errors->first('email', ' is-invalid'), 'required']) }}
                                @error('email')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- PASSWORD --}}
                            <div class="col-xl-6">
                                <label for="password" class="form-label font-weight-light text-uppercase text-muted">@lang('Password')</label>
                                {{ form()->password('password', ['class' => 'form-control'.$errors->first('password', ' is-invalid')]) }}
                                @error('password')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- PASSWORD CONFIRMATION --}}
                            <div class="col-xl-6">
                                <label for="password_confirmation" class="form-label font-weight-light text-uppercase text-muted">@lang('Confirm Password')</label>
                                {{ form()->password('password_confirmation', ['class' => 'form-control'.$errors->first('password_confirmation', ' is-invalid')]) }}
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin::auth.administrators.index') }}" class="btn btn-sm btn-light">
                            @lang('Cancel')
                        </a>
                        <button type="submit" class="btn btn-sm btn-primary">@lang('Save')</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-7">
                <div class="card card-borderless shadow-sm">
                    <div class="card-header px-2">@lang('Roles')</div>
                    <table class="table table-borderless table-hover mb-0">
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
                                        {{ form()->checkbox('roles[]', $role->uuid, in_array($role->uuid, old('roles', []))) }}
                                    </td>
                                    <td class="small">{{ $role->name }}</td>
                                    <td class="small">{{ $role->description }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    {{ form()->close() }}
@endsection
