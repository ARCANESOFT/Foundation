<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Models\Presenters;

use Illuminate\Support\{HtmlString, Str};

/**
 * Trait     AuthenticatablePresenter
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property-read  string                           display_name
 * @property-read  string                           full_name
 * @property-read  string                           masked_email
 * @property-read  string                           avatar
 * @property-read  \Illuminate\Support\HtmlString   avatar_img
 * @property-read  \Illuminate\Support\Carbon|null  last_activity_at
 * @property-read  string                           last_activity
 */
trait AuthenticatablePresenter
{
    /* -----------------------------------------------------------------
     |  Accessors & Mutators
     | -----------------------------------------------------------------
     */

    /**
     * Get the `display_name` attribute.
     *
     * @return string
     */
    public function getDisplayNameAttribute(): string
    {
        if ($this->hasName())
            return $this->getFullNameAttribute();

        return $this->username;
    }

    /**
     * Get the `full_name` attribute.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

    /**
     * Set the `first_name` attribute.
     *
     * @param  string|null  $firstName
     */
    public function setFirstNameAttribute($firstName)
    {
        if (is_null($firstName))
            return;

        $this->attributes['first_name'] = Str::title(Str::lower($firstName));
    }

    /**
     * Set the `last_name` attribute.
     *
     * @param  string|null  $lastName
     */
    public function setLastNameAttribute($lastName)
    {
        if (is_null($lastName))
            return;

        $this->attributes['last_name'] = Str::upper($lastName);
    }

    /**
     * Set the `email` attribute.
     *
     * @param  string  $email
     */
    public function setEmailAttribute(string $email)
    {
        $this->attributes['email'] = Str::lower($email);
    }

    /**
     * Get the `masked_email` attribute.
     *
     * @return string
     */
    public function getMaskedEmailAttribute(): string
    {
        $show  = 2;
        $parts = explode('@', $this->email);

        return substr($parts[0],0, $show).str_repeat('*', 3).'@'.$parts[1];
    }

    /**
     * Get the `avatar` attribute.
     *
     * @return string
     */
    public function getAvatarAttribute(): string
    {
        if ($this->attributes['avatar']) {
            return $this->attributes['avatar'];
        }

        return gravatar()
            ->setDefaultImage('blank')
            ->setSize(150)
            ->get($this->email);
    }

    /**
     * Get the `avatar_img` attribute.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function getAvatarImgAttribute(): HtmlString
    {
        return html()->image(
            $this->getAvatarAttribute(), $this->getDisplayNameAttribute(), ['class' => 'rounded-circle']
        );
    }

    /**
     * Get the last activity as human text.
     *
     * @return string
     */
    public function getLastActivityAttribute(): string
    {
        if (is_null($this->last_activity_at))
            return __('No recent activity');

        return $this->last_activity_at->diffForHumans();
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if has a name (first_name or last_name).
     *
     * @return bool
     */
    public function hasName(): bool
    {
        return ! empty($this->first_name)
            || ! empty($this->last_name);
    }
}
