@extends('foundation::authentication._template.master')

<?php /** @var  Illuminate\Support\ViewErrorBag  $errors */ ?>

@section('title')
    @lang('Confirm Password')
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-xxl-4">
            <x-arc:card>
                <x-arc:card-header class="text-center">@lang('Confirm Password')</x-arc:card-header>
                <x-arc:card-body>
                    <x-arc:form
                        action="{{ route(Arcanesoft\Foundation\Authentication\Http\Routes\ConfirmPasswordRoutes::STORE) }}"
                        method="POST">
                        <p class="small">@lang('Please confirm your password before continuing.')</p>

                        <div class="row row-cols-1 g-3">
                            {{-- PASSWORD --}}
                            <div class="col">
                                <x-arc:password-control
                                    name="password" label="Password" grouped="true"
                                    required autofocus autocomplete="current-password"/>
                            </div>
                            {{-- SUBMIT BUTTON --}}
                            <div class="col">
                                <button class="btn btn-lg btn-primary btn-block"
                                        type="submit">@lang('Confirm Password')</button>
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
