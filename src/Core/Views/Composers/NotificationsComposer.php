<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Views\Composers;

use Arcanedev\Notify\Contracts\Notify;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;

/**
 * Class     NotificationsComposer
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class NotificationsComposer
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const VIEW = 'foundation::_partials.notifications';

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\Notify\Contracts\Notify */
    protected $notifier;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * NotificationsComposer constructor.
     *
     * @param  \Arcanedev\Notify\Contracts\Notify  $notifier
     */
    public function __construct(Notify $notifier)
    {
        $this->notifier = $notifier;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Compose the view.
     *
     * @param  \Illuminate\Contracts\View\View  $view
     */
    public function compose(View $view)
    {
        $view->with(
            'foundationNotifications',
            $this->notifier->notifications()->transform(function (array $notification) {
                return static::prepareNotification($notification);
            })
        );
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Prepare the notification.
     *
     * @param  array  $notification
     *
     * @return array
     */
    protected static function prepareNotification(array $notification): array
    {
        return [
            'type'    => $notification['type'],
            'message' => $notification['message'],
            'icon'    => static::getIcon($notification['type']),
            'content' => $notification['extra']['content'] ?? null,
        ];
    }

    /**
     * Get the notification icon.
     *
     * @param  string  $type
     *
     * @return string|null
     */
    protected static function getIcon(string $type)
    {
        $icons = [
            'primary'   => 'fa-check',
            'secondary' => 'fa-check',
            'success'   => 'fa-check',
            'danger'    => 'fa-check',
            'warning'   => 'fa-check',
            'info'      => 'fa-check',
            'light'     => 'fa-check',
            'dark'      => 'fa-check',
        ];

        return Arr::get($icons, $type);
    }

    /**
     * Get the composer views.
     *
     * @return array
     */
    public function views(): array
    {
        return [
            static::VIEW,
        ];
    }
}
