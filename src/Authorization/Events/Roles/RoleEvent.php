<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Events\Roles;

use Arcanesoft\Foundation\Authorization\Models\Role;

/**
 * Class     RoleEvent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class RoleEvent
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    public const MODEL_EVENTS = [
        'retrieved' => RetrievedRole::class,
        'creating'  => CreatingRole::class,
        'created'   => CreatedRole::class,
        'updating'  => UpdatingRole::class,
        'updated'   => UpdatedRole::class,
        'saving'    => SavingRole::class,
        'saved'     => SavedRole::class,
        'deleting'  => DeletingRole::class,
        'deleted'   => DeletedRole::class,
    ];

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Authorization\Models\Role */
    public $role;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * RoleEvent constructor.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role  $role
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }
}
