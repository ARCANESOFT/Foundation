<div class="alert alert-success small" role="alert">
    @if($status == 'verification-link-sent')
        @lang('A new verification link has been sent to the email address you provided during registration.')
    @else
        {{ $status }}
    @endif
</div>
