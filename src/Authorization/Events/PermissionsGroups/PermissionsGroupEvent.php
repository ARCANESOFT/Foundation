<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Events\PermissionsGroups;

use Arcanesoft\Foundation\Authorization\Models\PermissionsGroup;

/**
 * Class     PermissionsGroupEvent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class PermissionsGroupEvent
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    public const MODEL_EVENTS = [
        'creating' => CreatingPermissionsGroup::class,
        'created'  => CreatedPermissionsGroup::class,
        'updating' => UpdatingPermissionsGroup::class,
        'updated'  => UpdatedPermissionsGroup::class,
        'saving'   => SavingPermissionsGroup::class,
        'saved'    => SavedPermissionsGroup::class,
        'deleting' => DeletingPermissionsGroup::class,
        'deleted'  => DeletedPermissionsGroup::class,
    ];

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Authorization\Models\PermissionsGroup */
    public $group;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * PermissionsGroupEvent constructor.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\PermissionsGroup  $group
     */
    public function __construct(PermissionsGroup $group)
    {
        $this->group = $group;
    }
}
