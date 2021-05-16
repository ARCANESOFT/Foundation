<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Traits;

/**
 * Trait     HasNotifications
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HasNotifications
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make a success notification.
     *
     * @param  string  $message
     * @param  string  $content
     * @param  array   $extra
     *
     * @return \Arcanedev\Notify\Contracts\Notify
     */
    protected static function notifySuccess(string $message, string $content, array $extra = [])
    {
        return static::notify($message, 'success', array_merge($extra, ['content' => __($content)]));
    }

    /**
     * Make a danger notification.
     *
     * @param  string  $message
     * @param  string  $content
     * @param  array   $extra
     *
     * @return \Arcanedev\Notify\Contracts\Notify
     */
    protected static function notifyError(string $message, string $content, array $extra = [])
    {
        return static::notify($message, 'danger', array_merge($extra, ['content' => __($content)]));
    }

    /**
     * Make a warning notification.
     *
     * @param  string  $message
     * @param  string  $content
     * @param  array   $extra
     *
     * @return \Arcanedev\Notify\Contracts\Notify
     */
    protected static function notifyWarning(string $message, string $content, array $extra = [])
    {
        return static::notify($message, 'warning', array_merge($extra, ['content' => __($content)]));
    }

    /**
     * Make a info notification.
     *
     * @param  string  $message
     * @param  string  $content
     * @param  array   $extra
     *
     * @return \Arcanedev\Notify\Contracts\Notify
     */
    protected static function notifyInfo(string $message, string $content, array $extra = [])
    {
        return static::notify($message, 'info', array_merge($extra, ['content' => __($content)]));
    }

    /**
     * Make a notification.
     *
     * @param  string  $message
     * @param  string  $type
     * @param  array   $extra
     *
     * @return \Arcanedev\Notify\Contracts\Notify
     */
    protected static function notify(string $message, string $type, array $extra = [])
    {
        return notify()->flash(__($message), $type, $extra);
    }
}
