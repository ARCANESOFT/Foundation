<?php namespace Arcanesoft\Foundation\Seeds;

use Arcanesoft\Auth\Models\Permission;
use Arcanesoft\Auth\Models\Role;
use Arcanesoft\Auth\Seeds\RolesSeeder;
use Illuminate\Support\Str;

/**
 * Class     RoleTableSeeder
 *
 * @package  Arcanesoft\Auth\Seeds\Foundation
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RolesTableSeeder extends RolesSeeder
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->seed([
            [
                'name'        => 'LogViewer Manager',
                'description' => 'The LogViewer manager role.',
                'is_locked'   => true,
            ],
            [
                'name'        => 'Backups Manager',
                'description' => 'The Backups manager role.',
                'is_locked'   => true,
            ],
        ]);

        $this->syncAdminRole();
        $this->syncRoles();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Sync the roles.
     *
     * @todo: Refactor this method
     */
    private function syncRoles()
    {
        /** @var \Illuminate\Database\Eloquent\Collection $permissions */
        $permissions = Permission::all();
        $roles       = [
            'logviewer-manager' => 'foundation.logviewer.',
            'backups-manager'   => 'foundation.backups.',
        ];

        foreach ($roles as $roleSlug => $permissionSlug) {
            /** @var  \Arcanesoft\Auth\Models\Role  $role */
            $role = Role::where('slug', $roleSlug)->first();
            $ids  = $permissions->filter(function (Permission $permission) use ($permissionSlug) {
                return Str::startsWith($permission->slug, $permissionSlug);
            })->pluck('id')->toArray();

            $role->permissions()->sync($ids);
        }
    }
}
