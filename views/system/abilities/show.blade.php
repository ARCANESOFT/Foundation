<x-arc:layout>
    @section('page-title')
        <i class="fas fa-fw fa-user-shield"></i> @lang('Abilities')
    @endsection

    <?php /** @var  Arcanedev\LaravelPolicies\Ability  $ability */ ?>

    <div class="row row-cols-lg-2">
        <div class="col">
            <x-arc:card>
                <x-arc:card-header>@lang('Ability')</x-arc:card-header>
                <x-arc:card-table>
                    <tbody>
                        <tr>
                            <x-arc:table-th label="Key"/>
                            <td class="text-right">
                                <span class="badge border border-muted text-muted">{{ $ability->key() }}</span>
                            </td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Method"/>
                            <td class="text-right small font-monospace">
                                @if($ability->isClosure())
                                    Closure
                                @else
                                    @php([$class, $method] = explode('@', $ability->method()))
                                    <abbr title="{{ $ability->method() }}">{{ class_basename($class).'@'.$method }}</abbr>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Category"/>
                            <td class="text-right small">{{ $ability->meta('category') }}</td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Name"/>
                            <td class="text-right small">{{ $ability->meta('name') }}</td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Description"/>
                            <td class="text-right small">{{ $ability->meta('description') }}</td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Registered"/>
                            <td class="text-right">
                                @if ($ability->meta('is_registered', false))
                                    <span class="badge border border-success text-success" data-toggle="tooltip" title="@lang('Yes')">
                                        <i class="fas fa-fw fa-check"></i>
                                    </span>
                                @else
                                    <span class="badge border border-secondary text-secondary" data-toggle="tooltip" title="@lang('No')">
                                        <i class="fas fa-fw fa-ban"></i>
                                    </span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </x-arc:card-table>
                <x-arc:card-footer>
                    @can(Arcanesoft\Foundation\System\Policies\AbilitiesPolicy::ability('index'))
                        <a href="{{ route('admin::system.abilities.index') }}"
                           class="btn btn-sm btn-light">@lang('Return back')</a>
                    @endcan
                </x-arc:card-footer>
            </x-arc:card>
        </div>
    </div>
</x-arc:layout>
