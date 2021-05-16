<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Events\Users;

use Arcanesoft\Foundation\Authorization\Models\User;
use Illuminate\Foundation\Events\Dispatchable;

/**
 * Class     UserEvent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class UserEvent
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    public const MODEL_EVENTS = [
        'retrieved'    => RetrievedUser::class,
        'creating'     => CreatingUser::class,
        'created'      => CreatedUser::class,
        'updating'     => UpdatingUser::class,
        'updated'      => UpdatedUser::class,
        'saving'       => SavingUser::class,
        'saved'        => SavedUser::class,
        'deleting'     => DeletingUser::class,
        'deleted'      => DeletedUser::class,
        'forceDeleted' => ForceDeletedUser::class,
        'restoring'    => RestoringUser::class,
        'restored'     => RestoredUser::class,
        'replicating'  => ReplicatingUser::class,
    ];

    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use Dispatchable;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Authorization\Models\User */
    public $user;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * UserEvent constructor.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\User|mixed  $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
