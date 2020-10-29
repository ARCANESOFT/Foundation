@extends('foundation::authentication._template.master')

<?php /** @var  Illuminate\Support\ViewErrorBag  $errors */ ?>

@section('title')
    @lang('Reset Password')
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-header p-3">
                    <h3 class="h5 font-weight-light text-uppercase text-muted text-center m-0">@lang('Reset Password')</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route(Arcanesoft\Foundation\Authentication\Http\Routes\PasswordResetRoutes::UPDATE) }}" method="POST" class="form form-reset-password">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row g-3">
                            <div class="col-12">
                                {{-- EMAIL --}}
                                <div class="form-label-group">
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                           class="form-control {{ $errors->first('email', 'is-invalid') }}"
                                           placeholder="@lang('E-Mail Address')" required autofocus>
                                    <label for="email">@lang('E-Mail Address')</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                {{-- PASSWORD --}}
                                <div class="form-label-group">
                                    <input type="password" id="password" name="password"
                                           class="form-control {{ $errors->first('password', 'is-invalid') }}"
                                           placeholder="@lang('Password')" required autocomplete="new-password">
                                    <label for="password">@lang('Password')</label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                {{-- PASSWORD CONFIRMATION --}}
                                <div class="form-label-group">
                                    <input type="password" id="password-confirm" name="password_confirmation"
                                           class="form-control {{ $errors->first('password_confirmation', 'is-invalid') }}"
                                           placeholder="@lang('Confirm Password')" required  autocomplete="new-password">
                                    <label for="password-confirm">@lang('Confirm Password')</label>
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-lg btn-primary btn-block" type="submit">@lang('Reset Password')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
