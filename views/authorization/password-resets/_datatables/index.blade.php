<?php
/**
 * @var  \Illuminate\Pagination\LengthAwarePaginator|Arcanesoft\Foundation\Authorization\Models\PasswordReset[]  $passwordResets
 * @var  array                                                                                          $fields
 */
?>

<x-arc:card>
    @if ($passwordResets->isNotEmpty())
        <x-arc:card-header>
            @include('foundation::_includes.datatable.datatable-header')
        </x-arc:card-header>
        <x-arc:card-table>
            <thead>
                <tr>
                    <x-arc:table-th>{{ $fields['email'] }}</x-arc:table-th>
                    <x-arc:table-th>{{ $fields['created_at'] }}</x-arc:table-th>
                    <x-arc:table-th class="text-right">{{ $fields['actions'] }}</x-arc:table-th>
                </tr>
            </thead>
            <tbody>
                @foreach($passwordResets as $passwordReset)
                    <tr>
                        <td class="small">{{ $passwordReset->email }}</td>
                        <td class="small">{{ $passwordReset->created_at }}</td>
                        <td class="text-right"></td>
                    </tr>
                @endforeach
            </tbody>
        </x-arc:card-table>
        <x-arc:card-footer>
            <x-arc:datatable-pagination :paginator="$passwordResets"/>
        </x-arc:card-footer>
    @else
        @include('foundation::_partials.no-data-found')
    @endif
</x-arc:card>
