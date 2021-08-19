<?php /** @var  Arcanesoft\Foundation\Authorization\Models\User  $user */ ?>

<div class="card card-borderless shadow-sm mb-3">
    <div class="card-body d-flex justify-content-center p-3">
        <div class="avatar avatar-xl">
            {{ html()->image($user->avatar, $user->full_name, []) }}
        </div>
    </div>
    <table class="table table-md mb-0">
        <tbody>
            <tr>
                <th>@lang('Full Name') :</th>
                <td class="text-right">{{ $user->full_name }}</td>
            </tr>
            <tr>
                <th>@lang('Email') :</th>
                <td class="text-right">
                    @if ($user->hasVerifiedEmail())
                        <i class="far fa-check-circle text-primary" data-toggle="tooltip" data-placement="top" title="@lang('Verified')"></i>
                    @endif
                    {{ $user->email }}
                </td>
            </tr>
            @if ($user->hasVerifiedEmail())
                <tr>
                    <th>@lang('Email Verified at') :</th>
                    <td class="text-right">
                        <small class="text-muted">{{ $user->email_verified_at }}</small>
                    </td>
                </tr>
            @endif
            <tr>
                <th>@lang('Status') :</th>
                <td class="text-right">
                    @if ($user->isActive())
                        <span class="badge badge-outline-success">
                            <i class="fa fa-check"></i> @lang('Activated')
                        </span>
                    @else
                        <span class="badge badge-outline-secondary">
                            <i class="fa fa-ban"></i> @lang('Deactivated')
                        </span>
                    @endif
                    @if ($user->isAdmin())
                        <span class="badge badge-outline-warning" data-toggle="tooltip" data-placement="top" title="@lang('Administrator')">
                            <i class="fas fa-crown"></i>
                        </span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>@lang('Last activity') :</th>
                <td class="text-right"><small class="text-muted">3 minutes ago</small></td>
            </tr>
            <tr>
                <th>@lang('Created at') :</th>
                <td class="text-right"><small class="text-muted">{{ $user->created_at }}</small></td>
            </tr>
            <tr>
                <th>@lang('Updated at') :</th>
                <td class="text-right"><small class="text-muted">{{ $user->updated_at }}</small></td>
            </tr>
        </tbody>
    </table>
    <div class="card-footer text-right px-2">
        @can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('show'), $user)
            {{ arcanesoft\ui\action_link('show', route('admin::authorization.users.show', [$user]))->size('sm') }}
        @endcan

        @can(Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::ability('update'), $user)
            {{ arcanesoft\ui\action_link('edit', route('admin::authorization.users.edit', [$user]))->size('sm') }}
        @endcan
    </div>
</div>
