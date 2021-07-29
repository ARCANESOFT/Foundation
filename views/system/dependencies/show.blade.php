<x-arc:layout>
    @section('page-title')
        <i class="fas fa-fw fa-user-shield"></i> @lang('System') <small>@lang('Dependencies')</small>
    @endsection

    @push('content-nav')
        @include('foundation::system._includes.system-nav')
    @endpush

    <div class="row">
        <div class="col-lg-6">
            <x-arc:card>
                <x-arc:card-header>@lang('Package')</x-arc:card-header>
                <x-arc:card-table>
                    <tbody>
                        <tr>
                            <x-arc:table-th label="Name"/>
                            <td class="text-right small">{{ $package['name'] }}</td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Version"/>
                            <td class="text-right">
                                <span class="badge border border-primary text-muted">{{ $package['version'] }}</span>
                            </td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Description" class="align-baseline"/>
                            <td class="text-right small">{{ $package['description'] }}</td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Type"/>
                            <td class="text-right small">{{ $package['type'] }}</td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Keywords" class="align-baseline"/>
                            <td class="text-right">
                                @foreach($package['keywords'] as $keyword)
                                    <span class="badge border border-secondary text-secondary ml-1">{{ $keyword }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Homepage"/>
                            <td class="text-right small">
                                <a href="{{ $package['homepage'] }}" target="_blank" rel="noopener">
                                    {{ $package['homepage'] }}
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </x-arc:card-table>
            </x-arc:card>
        </div>
    </div>
</x-arc:layout>
