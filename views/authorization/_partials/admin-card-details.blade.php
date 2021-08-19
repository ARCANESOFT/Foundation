<?php /** @var  Arcanesoft\Foundation\Authorization\Models\Administrator  $admin */ ?>

<div class="card card-borderless shadow-sm mb-3">
    <div class="card-body d-flex justify-content-center p-3">
        <div class="avatar avatar-xl">
            {{ html()->image($admin->avatar, $admin->full_name, []) }}
        </div>
    </div>
    <table class="table table-md mb-0">
        <tbody>
            <tr>
                <th class="table-th">@lang('Full Name') :</th>
                <td class="text-right">{{ $admin->full_name }}</td>
            </tr>
            <tr>
                <th class="table-th">@lang('Email') :</th>
                <td class="text-right">{{ $admin->email }}</td>
            </tr>
            @if ($admin->hasVerifiedEmail())
                <tr>
                    <th class="table-th">@lang('Email Verified at') :</th>
                    <td class="text-right">
                        <small class="text-muted">{{ $admin->email_verified_at }}</small>
                    </td>
                </tr>
            @endif
            <tr>
                <th class="table-th">@lang('Status') :</th>
                <td class="text-right">
                    @if ($admin->isActive())
                        <span class="badge badge-outline-success">
                            <i class="fa fa-check"></i> @lang('Activated')
                        </span>
                    @else
                        <span class="badge badge-outline-secondary">
                            <i class="fa fa-ban"></i> @lang('Deactivated')
                        </span>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    <div class="card-footer text-right px-2">
        @can(Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy::ability('show'), $admin)
            {{ arcanesoft\ui\action_link('show', route('admin::authorization.users.show', [$admin]))->size('sm') }}
        @endcan
    </div>
</div>
