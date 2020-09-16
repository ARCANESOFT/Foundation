<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Http\Requests;

use Arcanesoft\Foundation\Auth\Models\Entities\TwoFactor;
use Arcanesoft\Foundation\Fortify\Concerns\HasGuard;
use Arcanesoft\Foundation\Fortify\Contracts\TwoFactorAuthenticationProvider;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class     TwoFactorLoginRequest
 *
 * @package  Arcanesoft\Foundation\Fortify\Http\Requests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  string|null  code
 * @property  string|null  recovery_code
 */
abstract class TwoFactorLoginRequest extends FormRequest
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasGuard;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The user attempting the two factor challenge.
     *
     * @var mixed
     */
    protected $challengedUser;

    /**
     * Indicates if the user wished to be remembered after login.
     *
     * @var bool
     */
    protected $remember;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ! is_null($this->challengedUser());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'code'          => ['nullable', 'string'],
            'recovery_code' => ['nullable', 'string'],
        ];
    }

    /**
     * Determine if the request has a valid two factor code.
     *
     * @return bool
     */
    public function hasValidCode(): bool
    {
        if (is_null($this->code))
            return false;

        $secret = $this->twoFactorEntity()->getDecryptedSecret();

        return $this->getTwoFactorProvider()->verify($secret, $this->code);
    }

    /**
     * Get the valid recovery code if one exists on the request.
     *
     * @return string|null
     */
    public function validRecoveryCode(): ?string
    {
        if ( ! $this->recovery_code) {
            return null;
        }

        return $this->twoFactorEntity()->getValidRecoveryCode($this->recovery_code);
    }

    /**
     * Get the user that is attempting the two factor challenge.
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Administrator|\Arcanesoft\Foundation\Auth\Models\User|mixed|null
     */
    public function challengedUser()
    {
        if ($this->challengedUser) {
            return $this->challengedUser;
        }

        $model = $this->guard()->getProvider()->getModel();

        if (
            ! $this->session()->has('login.id') ||
            ! $user = $model::find($this->session()->pull('login.id'))
        ) {
            return null;
        }

        return $this->challengedUser = $user;
    }

    /**
     * Determine if the user wanted to be remembered after login.
     *
     * @return bool
     */
    public function remember(): bool
    {
        if ( ! $this->remember) {
            $this->remember = $this->session()->pull('login.remember', false);
        }

        return $this->remember;
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the user's two factory instance.
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Entities\TwoFactor
     */
    protected function twoFactorEntity(): TwoFactor
    {
        return $this->challengedUser()->two_factor;
    }

    /**
     * Get the two factor authentication provider.
     *
     * @return \Arcanesoft\Foundation\Fortify\Contracts\TwoFactorAuthenticationProvider
     */
    protected function getTwoFactorProvider(): TwoFactorAuthenticationProvider
    {
        return app(TwoFactorAuthenticationProvider::class);
    }
}
