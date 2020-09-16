<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

/**
 * Class     Password
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Password implements Rule
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The minimum length of the password.
     *
     * @var int
     */
    protected $length = 8;

    /**
     * Indicates if the password must contain one uppercase character.
     *
     * @var bool
     */
    protected $requireUppercase = false;

    /**
     * Indicates if the password must contain one numeric digit.
     *
     * @var int
     */
    protected $requireNumeric = false;

    /**
     * Indicates if the password can be nullable.
     *
     * @var bool
     */
    protected $nullable = false;

    /**
     * Indicates if the password must be confirmed.
     *
     * @var bool
     */
    protected $confirmed = false;

    /**
     * The message that should be used when validation fails.
     *
     * @var string
     */
    protected $message;

    /* -----------------------------------------------------------------
     |  Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the minimum length of the password.
     *
     * @param  int  $length
     *
     * @return $this
     */
    public function length(int $length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Indicate that at least one uppercase character is required.
     *
     * @return $this
     */
    public function requireUppercase()
    {
        $this->requireUppercase = true;

        return $this;
    }

    /**
     * Indicate that at least one numeric digit is required.
     *
     * @return $this
     */
    public function requireNumeric()
    {
        $this->requireNumeric = true;

        return $this;
    }

    /**
     * Indicate that can be nullable.
     *
     * @return $this
     */
    public function nullable()
    {
        $this->nullable = true;

        return $this;
    }

    /**
     * Indicate that password must be confirmed.
     *
     * @return $this
     */
    public function confirmed()
    {
        $this->confirmed = true;

        return $this;
    }

    /**
     * Set the message that should be used when the rule fails.
     *
     * @param  string  $message
     *
     * @return $this
     */
    public function withMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make a password instance.
     *
     * @return $this
     */
    public static function make()
    {
        return new static();
    }

    /**
     * Get the validation rules.
     *
     * @return array|string[]
     */
    public function rules(): array
    {
        $rules = [
            $this->nullable ? 'nullable' : 'required',
            'string',
            $this,
        ];

        if ($this->confirmed) {
            $rules[] = 'confirmed';
        }

        return $rules;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if ($this->requireUppercase && Str::lower($value) === $value)
            return false;

        if ($this->requireNumeric && ! preg_match('/[0-9]/', $value))
            return false;

        return Str::length($value) >= $this->length;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        if ($this->message) {
            return $this->message;
        }

        if ($this->requireUppercase && ! $this->requireNumeric) {
            return __('The :attribute must be at least '.$this->length.' characters and contain at least one uppercase character.');
        }
        elseif ($this->requireNumeric && ! $this->requireUppercase) {
            return __('The :attribute must be at least '.$this->length.' characters and contain at least one number.');
        }
        elseif ($this->requireUppercase && $this->requireNumeric) {
            return __('The :attribute must be at least '.$this->length.' characters and contain at least one uppercase character and number.');
        }

        return __('The :attribute must be at least '.$this->length.' characters.');
    }
}
