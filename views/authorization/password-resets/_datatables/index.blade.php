<?php
/**
 * @var  \Illuminate\Pagination\LengthAwarePaginator|Arcanesoft\Foundation\Auth\Models\PasswordReset[]  $passwordResets
 * @var  array                                                                                          $fields
 */
?>

<div class="card card-borderless shadow-sm">
    @if ($passwordResets->isNotEmpty())
        <div class="card-header px-2">
            @include('foundation::_components.datatable.datatable-header')
        </div>
        <table class="table table-borderless table-hover table-md mb-0">
            <thead>
                <tr>
                    <th class="font-weight-light text-uppercase text-muted">{{ $fields['email'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted">{{ $fields['created_at'] }}</th>
                    <th class="font-weight-light text-uppercase text-muted text-right">{{ $fields['actions'] }}</th>
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
        </table>
        <div class="card-footer px-2">
            @include('foundation::_components.datatable.datatable-footer', ['paginator' => $passwordResets])
        </div>
    @else
        @include('foundation::_partials.no-data-found')
    @endif
</div>
