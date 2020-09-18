<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Models\Presenters;

use Arcanedev\Agent\Contracts\Agent;
use Arcanedev\Agent\Detectors\DeviceDetector;
use Illuminate\Http\Request;
use Illuminate\Support\{Arr, Carbon, HtmlString, Str};

/**
 * Trait     SessionPresenter
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property-read  string                          device_name
 * @property-read  \Illuminate\Support\HtmlString  device_icon
 * @property-read  string                          client_name
 * @property-read  string                          os_name
 * @property-read  \Illuminate\Support\Carbon      last_activity_at
 */
trait SessionPresenter
{
    /* -----------------------------------------------------------------
     |  Accessors
     | -----------------------------------------------------------------
     */

    /**
     * Get the `last_activity_at` attribute.
     *
     * @return \Illuminate\Support\Carbon
     */
    public function getLastActivityAtAttribute(): Carbon
    {
        return Carbon::createFromTimestamp($this->last_activity);
    }

    /**
     * Get the `client_name` attribute.
     *
     * @return string
     */
    public function getClientNameAttribute(): string
    {
        return $this->device()->clientName();
    }

    /**
     * Get the `os_name` attribute.
     *
     * @return string
     */
    public function getOsNameAttribute(): string
    {
        return $this->device()->osName();
    }

    /**
     * Get the `device_name` attribute.
     *
     * @return string
     */
    public function getDeviceNameAttribute(): string
    {
        return Str::ucfirst($this->device()->getDeviceName());
    }

    /**
     * Get the `device_icon` attribute.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function getDeviceIconAttribute(): HtmlString
    {
        $icons = [
            'desktop'               => 'fas fa-fw fa-desktop',
            'smartphone'            => 'fas fa-fw fa-mobile-alt',
            'tablet'                => 'fas fa-fw fa-tablet-alt',
            'feature phone'         => 'fas fa-fw fa-mobile-alt',
            'console'               => 'fas fa-fw fa-gamepad',
            'tv'                    => 'fas fa-fw fa-tv',
            'car browser'           => 'fas fa-fw fa-car',
            'smart display'         => 'fas fa-fw fa-tablet-alt',
            'camera'                => 'fas fa-fw fa-camera',
            'portable media player' => 'fas fa-fw fa-play-circle',
            'phablet'               => 'fas fa-fw fa-tablet-alt',
            'smart speaker'         => 'fas fa-fw fa-microphone',
            'wearable'              => 'fas fa-fw fa-clock',
        ];

        $icon = Arr::get($icons, $this->device()->getDeviceName(), 'fa fa-fw fa-question');

        return new HtmlString(
            '<i class="'.$icon.'" title="'.$this->getDeviceNameAttribute().'" data-toggle="tooltip"></i>'
        );
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the agent detector.
     *
     * @todo Cache the result ??
     *
     * @return \Arcanedev\Agent\Detectors\DeviceDetector
     */
    public function device(): DeviceDetector
    {
        $request = Request::create('session', 'GET', [], [], [], [
            'HTTP_USER_AGENT' => $this->user_agent,
        ]);

        return app(Agent::class)->parse($request)->device();
    }
}
