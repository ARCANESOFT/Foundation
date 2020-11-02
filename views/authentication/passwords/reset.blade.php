@extends('foundation::authentication._template.master')

<?php /** @var  Illuminate\Support\ViewErrorBag  $errors */ ?>

@section('title')
    @lang('Reset Password')
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <x-arc:card>
                <x-arc:card-header class="text-center">@lang('Reset Password')</x-arc:card-header>
                <x-arc:card-body>
                    <x-arc:form
                        action="{{ route(Arcanesoft\Foundation\Authentication\Http\Routes\PasswordResetRoutes::UPDATE) }}"
                        method="POST">
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row row-cols-1 g-3">
                            {{-- EMAIL --}}
                            <div class="col">
                                <x-arc:input-control
                                    type="email" name="email" label="E-Mail Address" :value="old('email')"
                                    required autofocus autocomplete="username" grouped="true"/>
                            </div>

                            {{-- PASSWORD --}}
                            <div class="col">
                                <x-arc:password-control
                                    name="password" label="Password" grouped="true"
                                    required autocomplete="new-password"/>
                            </div>

                            {{-- PASSWORD CONFIRMATION --}}
                            <div class="col">
                                <x-arc:password-control
                                    name="password_confirmation" label="Confirm Password" grouped="true"
                                    required autocomplete="new-password"/>
                            </div>

                            {{-- SUBMIT BUTTON --}}
                            <div class="col">
                                <button class="btn btn-lg btn-primary btn-block"
                                        type="submit">@lang('Reset Password')</button>
                            </div>
                        </div>
                    </x-arc:form>
                </x-arc:card-body>
            </x-arc:card>
        </div>
    </div>
@endsection
