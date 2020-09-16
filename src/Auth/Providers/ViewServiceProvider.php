<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Providers;

use Arcanesoft\Foundation\Auth\Views\Components\{
    AdministratorsDatatable, PasswordResetsDatatable, PermissionsDatatable, RolesDatatable, UsersDatatable
};
use Arcanesoft\Foundation\Support\Providers\ViewServiceProvider as ServiceProvider;

/**
 * Class     ViewServiceProvider
 *
 * @package  Arcanesoft\Foundation\Auth\Providers
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
