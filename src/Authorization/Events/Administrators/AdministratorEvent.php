<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Events\Administrators;

use Arcanesoft\Foundation\Authorization\Models\Administrator;

/**
 * Class     AdministratorEvent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class AdministratorEvent
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    public const MODEL_EVENTS = [
        'retrieved'    => RetrievedAdministrator::class,
        'creating'     => CreatingAdministrator::class,
        'created'      => CreatedAdministrator::class,
        'updating'     => UpdatingAdministrator::class,
        'updated'      => UpdatedAdministrator::class,
        'saving'       => SavingAdministrator::class,
        'saved'        => SavedAdministrator::class,
        'deleting'     => DeletingAdministrator::class,
        'deleted'      => DeletedAdministrator::class,
        'forceDeleted' => ForceDeletedAdministrator::class,
        'restoring'    => RestoringAdministrator::class,
        'restored'     => RestoredAdministrator::class,
        'replicating'  => ReplicatingAdministrator::class,
    ];

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Authorization\Models\Administrator */
    public $administrator;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * AdminEvent constructor.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator  $administrator
     */
    public function __construct(Administrator $administrator)
    {
        $this->administrator = $administrator;
    }
}
