@extends('foundation::authentication._template.master')

<?php /** @var  Illuminate\Support\ViewErrorBag  $errors */ ?>

@section('title')
    @lang('Login')
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5 col-xxl-4">
            <x-arc:card>
                <x-arc:card-header class="text-center">@lang('Login')</x-arc:card-header>
                <x-arc:card-body>
                    @includeWhen(session()->has('status'), 'foundation::authentication._partials.status', ['status' => session('status')])

                    <x-arc:form
                        action="{{ route(Arcanesoft\Foundation\Authentication\Http\Routes\LoginRoutes::LOGIN_STORE) }}"
                        method="POST">
                        <div class="row row-cols-1 g-3">
                            {{-- EMAIL --}}
                            <div class="col">
                                <x-arc:input-control
                                    type="email" name="email" label="E-Mail Address" placeholder="E-Mail Address"
                                    required autofocus autocomplete="username" grouped="true"/>
                            </div>

                            {{-- PASSWORD --}}
                            <div class="col">
                                <x-arc:password-control
                                    name="password" label="Password" placeholder="Password"
                                    required autocomplete="current-password" grouped="true"/>
                            </div>

                            {{-- REMEMBER ME --}}
                            <div class="col">
                                <x-arc:checkbox-control
                                    name="remember" label="Remember Me" value="yes"
                                    :checked="old('remember') === 'yes'"/>
                            </div>

                            {{-- SUBMIT BUTTON --}}
                            <div class="col">
                                <button class="btn btn-lg btn-primary btn-block"
                                        type="submit">@lang('Login')</button>
                            </div>
                        </div>
                    </x-arc:form>
                </x-arc:card-body>

                @if (app('router')->has($route = Arcanesoft\Foundation\Authentication\Http\Routes\PasswordResetRoutes::REQUEST))
                    <x-arc:card-footer class="text-center">
                        <a class="btn btn-link" href="{{ route($route) }}">@lang('Forgot your password?')</a>
                    </x-arc:card-footer>
                @endif
            </x-arc:card>
        </div>
    </div>
@endsection
