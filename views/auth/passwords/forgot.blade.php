@extends('foundation::auth._template.master')

<?php /** @var  Illuminate\Support\ViewErrorBag  $errors */ ?>

@section('title')
    @lang('Reset Password')
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-xxl-4">
            <div class="card shadow-sm">
                <div class="card-header p-3">
                    <h3 class="h5 font-weight-light text-uppercase text-muted text-center m-0">@lang('Confirm Password')</h3>
                </div>
                <div class="card-body">
                    <p class="small">@lang('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.')</p>

                    @if (session('status'))
                        <p class="font-weight-bold small text-success">{{ session('status') }}</p>
                    @endif

                    <form action="{{ route(Arcanesoft\Foundation\Authentication\Http\Routes\PasswordResetRoutes::EMAIL) }}" method="POST">
                        @csrf

                        <div class="row g-3">
                            <div class="col-lg-12">
                                {{-- EMAIL --}}
                                <div class="form-label-group">
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                           class="form-control {{ $errors->first('email', 'is-invalid') }}"
                                           placeholder="@lang('E-Mail Address')" required autofocus>
                                    <label for="email">@lang('E-Mail Address')</label>
                                    @error('email')
                                    <span class="invalid-feedback font-weight-bold" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-lg btn-primary btn-block" type="submit">@lang('Email Password Reset Link')</button>
                            </div>
                        </div>
                    </form>
                </div>
                @if (app('router')->has($route = Arcanesoft\Foundation\Authentication\Http\Routes\LoginRoutes::LOGIN_CREATE))
                    <div class="card-footer py-3 text-center">
                        <a href="{{ route($route) }}" class="text-decoration-none">@lang("Just remember your password? Login")</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
