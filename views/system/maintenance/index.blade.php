<?php
/**
 * @var  Arcanesoft\Foundation\System\Helpers\MaintenanceMode  $maintenance
 * @var  Illuminate\Support\ViewErrorBag                       $errors
 */
?>
<x-arc:layout>
    @section('page-title')
        <i class="far fa-fw fa-stop-circle"></i> @lang('System') <small>@lang('Maintenance')</small>
    @endsection

    @push('content-nav')
        @include('foundation::system._includes.system-nav')
    @endpush

    <div class="row g-3">
        <div class="col-12 col-lg-4">
            <x-arc:card>
                <x-arc:card-header>@lang('Maintenance Mode')</x-arc:card-header>
                @if ($maintenance->isEnabled())
                    <?php $maintenanceData = $maintenance->data() ?>
                    <x-arc:card-table>
                        <tr>
                            <x-arc:table-th label="Status"/>
                            <td class="text-end">
                                <span class="badge border border-danger text-muted">
                                    <i class="fas fa-fw fa-exclamation-triangle text-danger"></i> @lang('Enabled')
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Time"/>
                            <td class="text-end small">{{ $maintenanceData['time'] ?? 'null' }}</td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Message"/>
                            <td class="text-end small">{{ $maintenanceData['message'] ?? 'null' }}</td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Allowed"/>
                            <td class="text-end">
{{--                                @forelse($maintenanceData['allowed'] as $allowed)--}}
{{--                                    <span class="badge border border-secondary">{{ $allowed }}</span>--}}
{{--                                @empty--}}
{{--                                    <span class="badge border border-warning">@lang('No one is allowed')</span>--}}
{{--                                @endforelse--}}
                            </td>
                        </tr>
                        @if ($maintenanceData['retry'])
                        <tr>
                            <x-arc:table-th label="Retry"/>
                            <td class="text-end">{{ $maintenanceData['retry'] }}</td>
                        </tr>
                        @endif
                        @if ($maintenanceData['status'])
                            <tr>
                                <x-arc:table-th label="Status"/>
                                <td class="text-end">{{ $maintenanceData['status'] }}</td>
                            </tr>
                        @endif
                    </x-arc:card-table>

                    @can (Arcanesoft\Foundation\System\Policies\MaintenancePolicy::ability('toggle'))
                    <x-arc:card-footer class="text-end">
                        <x-arc:form action="{{ route('admin::system.maintenance.stop') }}" method="POST">
                            <button type="submit"
                                    class="btn btn-sm btn-outline-success">@lang('Stop Maintenance Mode')</button>
                        </x-arc:form>
                    </x-arc:card-footer>
                    @endcan
                @else
                    <x-arc:card-table>
                        <tr>
                            <td class="font-weight-light text-uppercase text-muted">@lang('Status')</td>
                            <td class="text-end">
                                <span class="badge border border-success text-muted">@lang('Disabled')</span>
                            </td>
                        </tr>
                    </x-arc:card-table>
                @endif
            </x-arc:card>
        </div>

        @if ($maintenance->isDisabled())
            @can (Arcanesoft\Foundation\System\Policies\MaintenancePolicy::ability('toggle'))
            <div class="col-12 col-lg-8">
                <x-arc:card>
                    <x-arc:form action="{{ route('admin::system.maintenance.start') }}" method="POST">
                        <x-arc:card-body>
                            <div class="row row-cols-1 g-3">
                                {{-- REDIRECT --}}
                                <div class="col">
                                    <x-arc:input-control
                                        type="text" name="redirect" :value="old('redirect')" label="Redirect URL"
                                        grouped="true" required/>
                                </div>

                                {{-- SECRET --}}
                                <div class="col">
                                    <x-arc:input-control
                                        type="text" name="secret" :value="old('secret')" label="Secret"
                                        grouped="true" required/>
                                </div>

                                {{-- STAY CONNECTED --}}
                                <div class="col">
                                    <x-arc:checkbox-control
                                        name="stay_connected" label="Stay connected"/>
                                </div>

                                {{-- STATUS CODE --}}
                                <div class="col">
                                    <x-arc:input-control
                                        type="text" name="status" :value="old('status', 503)" label="Status code"
                                        grouped="true" required/>
                                </div>

                                {{-- TEMPLATE --}}
                                <div class="col">
                                    <x-arc:select-control
                                        name="template" label="Template"
                                        :value="old('template', $maintenance->getDefaultTemplate())"
                                        :options="$maintenance->getTemplates()"
                                        grouped="true"/>
                                </div>

                                {{-- RETRY --}}
                                <div class="col">
                                    <x-arc:input-control
                                        type="number" name="retry" label="Retry"
                                        :value="old('retry')" min="0"/>
                                </div>
                            </div>
                        </x-arc:card-body>
                        <x-arc:card-footer class="text-end">
                            <button type="submit"
                                    class="btn btn-sm btn-outline-danger">@lang('Start Maintenance Mode')</button>
                        </x-arc:card-footer>
                    </x-arc:form>
                </x-arc:card>
            </div>
            @endcan
        @endif
    </div>
</x-arc:layout>
