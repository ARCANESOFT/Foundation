@extends('foundation::authentication._template.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5 col-xxl-4">
            <x-arc:card>
                <x-arc:card-header class="text-center">@lang('Email verification')</x-arc:card-header>
                <x-arc:card-body>
                    <p class="small">
                        @lang('Thanks for signing up!')
                        @lang('Before getting started, could you verify your email address by clicking on the link we just emailed to you?')
                        @lang("If you didn't receive the email, we will gladly send you another.")
                    </p>

                    @includeWhen(session()->has('status'), 'foundation::authentication._partials.status', ['status' => session('status')])

                    <x-arc:form
                        action="{{ route(Arcanesoft\Foundation\Authentication\Http\Routes\EmailVerificationRoutes::RESEND) }}"
                        method="POST">
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit">@lang('Resend verification email')</button>
                        </div>
                    </x-arc:form>
                </x-arc:card-body>
                <x-arc:card-footer>
                    <x-arc:form
                        action="{{ route(Arcanesoft\Foundation\Authentication\Http\Routes\LoginRoutes::LOGOUT) }}"
                        method="DELETE">
                        <button class="btn btn-link m-0 p-0"
                                type="submit">@lang('Logout')</button>
                    </x-arc:form>
                </x-arc:card-footer>
            </x-arc:card>
        </div>
    </div>
</div>
@endsection
