<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Database;

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Repositories\{PermissionsRepository, RolesRepository};
use Arcanesoft\Foundation\Support\Database\Seeder;
use Illuminate\Support\{Arr, Collection, Str};
use Illuminate\Support\Facades\Date;

/**
 * Class     RolesSeeder
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class RolesSeeder extends Seeder
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Seed multiple roles.
     *
     * @param  array  $roles
     */
    public function seedMany(array $roles): void
    {
        $roles = array_map(function (array $role) {
            return static::prepareRole($role);
        }, $roles);


        $this->getRolesRepository()->insert($roles);

        $this->syncAdminRole();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the roles repository.
     *
     * @return \Arcanesoft\Foundation\Auth\Repositories\RolesRepository|mixed
     */
    private function getRolesRepository()
    {
        return $this->container->make(RolesRepository::class);
    }

    /**
     * Get the permissions repository.
     *
     * @return \Arcanesoft\Foundation\Auth\Repositories\PermissionsRepository|mixed
     */
    private function getPermissionsRepository()
    {
        return $this->container->make(PermissionsRepository::class);
    }

    /**
     * Prepare the role for seed.
     *
     * @param  array  $role
     *
     * @return array
     */
    protected static function prepareRole(array $role): array
    {
        $now = Date::now();

        return array_merge($role, [
            'uuid'         => $role['uuid'] ?? Str::uuid(),
            'key'          => $role['key'] ?? Auth::slugRoleKey($role['name']),
            'is_locked'    => $role['is_locked'] ?? true,
            'activated_at' => $now,
            'created_at'   => $now,
            'updated_at'   => $now,
        ]);
    }

    /**
     * Sync the admin role with all permissions.
     */
    private function syncAdminRole(): void
    {
        $rolesRepo = $this->getRolesRepository();

        $rolesRepo->syncPermissionsByIds(
            $rolesRepo->getAdminRole(),
            $this->getPermissionsRepository()->getAllIds()->toArray()
        );
    }

    /**
     * Sync the roles with permissions.
     *
     * @param  array  $roles
     */
    protected function syncRolesWithPermissions(array $roles): void
    {
        $rolesRepo   = $this->getRolesRepository();
        $permissions = $this->getPermissionsRepository()->pluck('ability', 'id');

        foreach ($roles as $key => $needles) {
            if ($role = $rolesRepo->firstWithKeyOrFail($key)) {
                $rolesRepo->syncPermissionsByIds(
                    $role, static::getAllowedPermissions($permissions, $needles)
                );
            }
        }
    }

    /**
     * Get the allowed permissions' ids.
     *
     * @param  \Illuminate\Support\Collection  $permissions
     * @param  array|string                    $needles
     *
     * @return array
     */
    private static function getAllowedPermissions(Collection $permissions, $needles): array
    {
        $needles = Arr::wrap($needles);

        return $permissions->filter(function ($ability) use ($needles) {
            return Str::startsWith($ability, $needles) || Str::is($needles, $ability);
        })->keys()->toArray();
    }
}
