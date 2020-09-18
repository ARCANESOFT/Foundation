<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Database;

use Arcanedev\LaravelPolicies\Ability;
use Arcanedev\LaravelPolicies\Contracts\PolicyManager;
use Arcanesoft\Foundation\Auth\Models\Permission;
use Arcanesoft\Foundation\Auth\Repositories\PermissionsGroupsRepository;
use Arcanesoft\Foundation\Support\Database\Seeder;
use Illuminate\Support\{Collection, Str};

/**
 * Class     PermissionsSeeder
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class PermissionsSeeder extends Seeder
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Seed permissions.
     *
     * @param  array                                                     $group
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission[]|iterable  $permissions
     */
    public function seed(array $group, iterable $permissions)
    {
        /** @var  \Arcanesoft\Foundation\Auth\Repositories\PermissionsGroupsRepository  $repo */
        $repo = $this->container->make(PermissionsGroupsRepository::class);

        $repo->createOneWithPermissions($group, $permissions);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get permissions from policy manager.
     *
     * @param  string|array  $abilities
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getPermissionsFromPolicyManager($abilities): Collection
    {
        return $this->policyManager()->abilities()
            ->filter(function (Ability $ability) use ($abilities) {
                return Str::startsWith($ability->key(), $abilities);
            })
            ->transform(function (Ability $ability) {
                return new Permission(array_merge($ability->metas(), [
                    'ability' => $ability->key(),
                ]));
            });
    }

    /**
     * Get the policy manager instance.
     *
     * @return \Arcanedev\LaravelPolicies\Contracts\PolicyManager|mixed
     */
    protected function policyManager(): PolicyManager
    {
        return $this->container->make(PolicyManager::class);
    }
}
