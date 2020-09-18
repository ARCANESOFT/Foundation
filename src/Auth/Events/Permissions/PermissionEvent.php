<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Permissions;

use Arcanesoft\Foundation\Auth\Models\Permission;

/**
 * Class     PermissionEvent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class PermissionEvent
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    public const MODEL_EVENTS = [
        'retrieved' => RetrievedPermission::class,
        'creating'  => CreatingPermission::class,
        'created'   => CreatedPermission::class,
        'updating'  => UpdatingPermission::class,
        'updated'   => UpdatedPermission::class,
        'saving'    => SavingPermission::class,
        'saved'     => SavedPermission::class,
        'deleting'  => DeletingPermission::class,
        'deleted'   => DeletedPermission::class,
    ];

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Auth\Models\Permission */
    public $permission;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * PermissionEvent constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission  $permission
     */
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }
}
