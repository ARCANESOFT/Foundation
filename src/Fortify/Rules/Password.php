<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Rules;

use Illuminate\Validation\Rules\Password as IlluminatePassword;

/**
 * Class     Password
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Password extends IlluminatePassword
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * If the password can be nullable.
     *
     * @var bool
     */
    protected $nullable = false;

    /**
     * If the password requires confirmation.
     *
     * @var bool
     */
    protected $confirmed = false;

    /**
     * If the password should match the current one.
     *
     * @var string|null
     */
    protected $current = null;

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Indicate that password can be nullable.
     *
     * @return $this
     */
    public function nullable(): self
    {
        $this->nullable = true;

        return $this;
    }

    /**
     * Indicate that password must be confirmed.
     *
     * @return $this
     */
    public function confirmed(): self
    {
        $this->confirmed = true;

        return $this;
    }

    /**
     * Indicates if the password must be matches with the current one.
     *
     * @param  string|null  $guard
     *
     * @return $this
     */
    public function current(?string $guard): self
    {
        $this->current = "password:{$guard}";

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public static function make(int $size = 8): self
    {
        return static::min($size);
    }

    /**
     * Get the validation's rules.
     *
     * @param  array  $extra
     *
     * @return array
     */
    public function rules(array $extra = []): array
    {
        $rules = [
            $this->nullable ? 'nullable' : 'required',
            $this,
        ];

        if ($this->confirmed)
            $rules[] = 'confirmed';

        if ($this->current)
            $rules[] = $this->current;

        return array_merge($rules, $extra);
    }
}
