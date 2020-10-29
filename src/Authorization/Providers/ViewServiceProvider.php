<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Providers;

use Arcanesoft\Foundation\Authorization\Views\Components\AdministratorsDatatable;
use Arcanesoft\Foundation\Authorization\Views\Components\PasswordResetsDatatable;
use Arcanesoft\Foundation\Authorization\Views\Components\PermissionsDatatable;
use Arcanesoft\Foundation\Authorization\Views\Components\RolesDatatable;
use Arcanesoft\Foundation\Authorization\Views\Components\UsersDatatable;
use Arcanesoft\Foundation\Support\Providers\ViewServiceProvider as ServiceProvider;

/**
 * Class     ViewServiceProvider
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ViewServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Get the view composers.
     *
     * @return array
     */
    public function components(): array
    {
        return [
            AdministratorsDatatable::NAME => AdministratorsDatatable::class,
            UsersDatatable::NAME          => UsersDatatable::class,
            RolesDatatable::NAME          => RolesDatatable::class,
            PermissionsDatatable::NAME    => PermissionsDatatable::class,
            PasswordResetsDatatable::NAME => PasswordResetsDatatable::class,
        ];
    }
}
