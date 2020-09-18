<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\PermissionsGroups;

use Arcanesoft\Foundation\Auth\Models\PermissionsGroup;

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

    /** @var  \Arcanesoft\Foundation\Auth\Models\PermissionsGroup */
    public $group;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * PermissionsGroupEvent constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\PermissionsGroup  $group
     */
    public function __construct(PermissionsGroup $group)
    {
        $this->group = $group;
    }
}
