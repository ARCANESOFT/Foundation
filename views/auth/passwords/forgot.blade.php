@extends('foundation::auth._template.master')

<?php /** @var  Illuminate\Support\ViewErrorBag  $errors */ ?>

@section('title')
    @lang('Reset Password')
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xxl-4">
            <x-arc:card>
                <x-arc:card-header class="text-center">@lang('Reset Password')</x-arc:card-header>

                <x-arc:card-body>
                    <p class="small">@lang('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.')</p>

                    @if (session('status'))
                        <p class="font-weight-bold small text-success">{{ session('status') }}</p>
                    @endif

                    <x-arc:form
                        action="{{ route(Arcanesoft\Foundation\Authentication\Http\Routes\PasswordResetRoutes::EMAIL) }}"
                        method="POST">
                        <div class="row row-cols-1 g-3">
                            {{-- EMAIL --}}
                            <div class="col">
                                <x-arc:input-control
                                    type="email" name="email" label="E-Mail Address"
                                    required autofocus autocomplete="username" grouped="true"/>
                            </div>
                            {{-- SUBMIT BUTTON --}}
                            <div class="col">
                                <button class="btn btn-lg btn-primary btn-block" type="submit">
                                    @lang('Email Password Reset Link')
                                </button>
                            </div>
                        </div>
                    </x-arc:form>
                </x-arc:card-body>

                @if (app('router')->has($route = Arcanesoft\Foundation\Authentication\Http\Routes\LoginRoutes::LOGIN_CREATE))
                    <x-arc:card-footer class="text-center">
                        <a href="{{ route($route) }}" class="text-decoration-none">@lang("Just remember your password? Login")</a>
                    </x-arc:card-footer>
                @endif
            </x-arc:card>
        </div>
    </div>
@endsection
