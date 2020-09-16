@extends('foundation::auth._template.master')

<?php /** @var  Illuminate\Support\ViewErrorBag  $errors */ ?>

@section('title')
    @lang('Login')
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-xxl-4">
            <div class="card shadow-sm">
                <div class="card-header p-3">
                    <h3 class="h5 font-weight-light text-uppercase text-muted text-center m-0">@lang('Login')</h3>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <p class="font-weight-bold small text-success">{{ session('status') }}</p>
                    @endif

                    <form action="{{ route(Arcanesoft\Foundation\Authentication\Http\Routes\LoginRoutes::LOGIN_STORE) }}" method="POST" class="form">
                        @csrf

                        <div class="row g-3">
                            <div class="col-lg-12">
                                {{-- EMAIL --}}
                                <div class="form-label-group">
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                           class="form-control{{ $errors->first('email', ' is-invalid') }}"
                                           placeholder="@lang('E-Mail Address')" required autofocus autocomplete="username">
                                    <label for="email">@lang('E-Mail Address')</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                {{-- PASSWORD --}}
                                <div class="form-label-group">
                                    <input type="password" id="password" name="password"
                                           class="form-control{{ $errors->first('email', ' is-invalid') }}"
                                           placeholder="@lang('Password')" required autocomplete="current-password">
                                    <label for="password">@lang('Password')</label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                {{-- REMEMBER ME --}}
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="yes" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">@lang('Remember Me')</label>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <button class="btn btn-lg btn-primary btn-block" type="submit">@lang('Login')</button>
                            </div>
                        </div>
                    </form>
                </div>

                @if (app('router')->has($route = Arcanesoft\Foundation\Authentication\Http\Routes\PasswordResetRoutes::REQUEST))
                <div class="card-footer text-center">
                    <a class="btn btn-link" href="{{ route($route) }}">@lang('Forgot your password?')</a>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
