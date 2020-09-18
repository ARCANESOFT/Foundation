<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Sessions;

use Arcanesoft\Foundation\Auth\Models\Session;

/**
 * Class     SessionEvent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class SessionEvent
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    public const MODEL_EVENTS = [
        'retrieved' => RetrievedSession::class,
        'creating'  => CreatingSession::class,
        'created'   => CreatedSession::class,
        'updating'  => UpdatingSession::class,
        'updated'   => UpdatedSession::class,
        'saving'    => SavingSession::class,
        'saved'     => SavedSession::class,
        'deleting'  => DeletingSession::class,
        'deleted'   => DeletedSession::class,
    ];

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Auth\Models\Session */
    public $session;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * SessionEvent constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Session  $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }
}
