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
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
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
            ]
        ]);

        $this->syncAdminRole();
        $this->syncRoles();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Sync the roles.
     *
     * @todo: Refactor this method
     */
    private function syncRoles()
    {
        $permissions = Permission::all();
        $roles       = [
            'logviewer-manager' => 'foundation.logviewer.'
        ];

        foreach ($roles as $roleSlug => $permissionSlug) {
            /** @var  \Arcanesoft\Auth\Models\Role  $role */
            $role = Role::where('slug', $roleSlug)->first();
            $ids  = $permissions->filter(function (Permission $permission) use ($permissionSlug) {
                return Str::startsWith($permission->slug, $permissionSlug);
            })->lists('id')->toArray();

            $role->permissions()->sync($ids);
        }
    }
}
