@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fa fa-fw fa-users"></i> @lang('Users') <small>@lang('Edit User')</small>
@endsection

<?php /** @var  App\Models\User|mixed  $user */ ?>

@section('content')
    {{ form()->open(['route' => ['admin::auth.users.update', $user], 'method' => 'PUT']) }}
        <div class="row">
            <div class="col-md-6">
                <div class="card card-borderless shadow-sm">
                    <div class="card-header">@lang('User')</div>
                    <div class="card-body">
                        <div class="row g-3">
                            {{-- FIRST NAME --}}
                            <div class="col-lg-6">
                                <label for="first_name" class="form-label font-weight-light text-uppercase">@lang('First Name')</label>
                                {{ form()->text('first_name', old('first_name', $user->first_name), ['class' => 'form-control'.$errors->first('first_name', ' is-invalid')]) }}
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- LAST NAME --}}
                            <div class="col-lg-6">
                                <label for="last_name" class="form-label font-weight-light text-uppercase">@lang('Last Name')</label>
                                {{ form()->text('last_name', old('last_name', $user->last_name), ['class' => 'form-control'.$errors->first('last_name', ' is-invalid')]) }}
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- EMAIL --}}
                            <div class="col-12">
                                <label for="email" class="form-label font-weight-light text-uppercase">@lang('Email')</label>
                                {{ form()->email('email', old('email', $user->email), ['class' => 'form-control'.$errors->first('email', ' is-invalid')]) }}
                                @error('email')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin::auth.users.show', [$user]) }}" class="btn btn-sm btn-light">@lang('Cancel')</a>
                        <button type="submit" class="btn btn-sm btn-primary">@lang('Save')</button>
                    </div>
                </div>
            </div>
        </div>
    {{ form()->close() }}
@endsection
