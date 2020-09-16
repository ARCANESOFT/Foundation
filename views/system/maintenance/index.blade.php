@extends(arcanesoft\foundation()->template())

<?php
/**
 * @var  Arcanesoft\Foundation\Helpers\MaintenanceMode  $maintenance
 * @var  Illuminate\Support\ViewErrorBag                $errors
 */
?>
@section('page-title')
    <i class="far fa-fw fa-stop-circle"></i> @lang('System') <small>@lang('Maintenance')</small>
@endsection

@section('content')
    @include('foundation::system._includes.system-nav')

    <div class="row">
        <div class="col-lg-4">
            <div class="card card-borderless shadow-sm mb-3">
                <div class="card-header px-2">@lang('Maintenance Mode')</div>
                @if ($maintenance->isEnabled())
                    @php($maintenanceData = $maintenance->data())
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Status')</td>
                            <td class="text-right">
                                <span class="badge border border-danger text-muted">
                                    <i class="fas fa-fw fa-exclamation-triangle text-danger"></i> @lang('Enabled')
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Time')</td>
                            <td class="text-right small">{{ $maintenanceData['time'] ?? 'null' }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Message')</td>
                            <td class="text-right small">{{ $maintenanceData['message'] ?? 'null' }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Allowed')</td>
                            <td class="text-right">
{{--                                @forelse($maintenanceData['allowed'] as $allowed)--}}
{{--                                    <span class="badge border border-secondary">{{ $allowed }}</span>--}}
{{--                                @empty--}}
{{--                                    <span class="badge border border-warning">@lang('No one is allowed')</span>--}}
{{--                                @endforelse--}}
                            </td>
                        </tr>
                        @if ($maintenanceData['retry'])
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Retry')</td>
                            <td class="text-right">{{ $maintenanceData['retry'] }}</td>
                        </tr>
                        @endif
                    </table>

                    @can (Arcanesoft\Foundation\System\Policies\MaintenancePolicy::ability('toggle'))
                    <div class="card-footer px-2 text-right">
                        <form action="{{ route('admin::system.maintenance.stop') }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-outline-success" type="submit">
                                @lang('Stop Maintenance Mode')
                            </button>
                        </form>
                    </div>
                    @endcan
                @else
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Status')</td>
                            <td class="text-right">
                                <span class="badge border border-success text-muted">@lang('Disabled')</span>
                            </td>
                        </tr>
                    </table>
                @endif
            </div>

            @if ($maintenance->isDisabled())
                @can (Arcanesoft\Foundation\System\Policies\MaintenancePolicy::ability('toggle'))
                    <div class="card card-borderless shadow-sm mb-3">
                        <form action="{{ route('admin::system.maintenance.start') }}" method="POST">
                            @csrf
                            <div class="card-body px-2">
                                {{-- ALLOWED IPS --}}
                                <div class="mb-3 {{ $errors->first('allowed', 'is-invalid') }}">
                                    <label for="allowed" class="form-label">@lang('Allowed')</label>
                                    {{ form()->textarea('allowed', old('allowed'), ['class' => 'form-control', 'rows' => 3]) }}
                                    <small id="allowedHelp" class="form-text text-muted">@lang('You can add multiple IP Addresses using newlines.')</small>
                                    @error('allowed')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- ALLOW CURRENT IP --}}
                                <div class="mb-3 {{ $errors->first('allow_current_ip', 'is-invalid') }}">
                                    <div class="form-check">
                                        {{ form()->checkbox('allow_current_ip', old('allow_current_ip', 1))->id('allow_current_ip')->class('form-check-input') }}
                                        <label class="form-check-label" for="allow_current_ip">@lang('Allow my current IP Address')</label>
                                    </div>

                                    @error('allow_current_ip')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- MESSAGE --}}
                                <div class="mb-3 {{ $errors->first('message', 'is-invalid') }}">
                                    <label for="message" class="form-label">@lang('Message')</label>
                                    {{ form()->text('message', old('message'), ['class' => 'form-control']) }}
                                    @error('message')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- RETRY --}}
                                <div class="mb-3 {{ $errors->first('retry', 'is-invalid') }}">
                                    <label for="retry" class="form-label">@lang('Retry')</label>
                                    {{ form()->number('retry', old('retry', 0), ['class' => 'form-control', 'min' => 0]) }}
                                    @error('retry')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer px-2 text-right">
                                <button class="btn btn-sm btn-outline-danger" type="submit">
                                    @lang('Start Maintenance Mode')
                                </button>
                            </div>
                        </form>
                    </div>
                @endcan
            @endif
        </div>
    </div>
@endsection

