<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Models\Entities;

use Arcanesoft\Foundation\Fortify\Contracts\TwoFactorAuthenticationProvider;
use Arcanesoft\Foundation\Fortify\Services\TwoFactorAuthentication\QrCode;
use Illuminate\Support\{Collection, HtmlString};

/**
 * Class     TwoFactor
 *
 * @package  Arcanesoft\Foundation\Auth\Models\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TwoFactor
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  string  */
    private $email;

    /** @var  string|null */
    protected $secret;

    /** @var  string|null */
    protected $recoveryCodes;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * TwoFactor constructor.
     *
     * @param  string       $email
     * @param  string|null  $secret
     * @param  string|null  $recoveryCodes
     */
    public function __construct(string $email, ?string $secret, ?string $recoveryCodes)
    {
        $this->email = $email;
        $this->secret = $secret;
        $this->recoveryCodes = $recoveryCodes;
    }

    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the secret code.
     *
     * @return string|null
     */
    public function getSecret(): ?string
    {
        return $this->secret;
    }

    /**
     * Get the decrypted secret code.
     *
     * @return string
     */
    public function getDecryptedSecret()
    {
        return decrypt($this->getSecret());
    }

    /**
     * Set the secret code.
     *
     * @param  string|null  $secret
     *
     * @return $this
     */
    public function setSecret(?string $secret)
    {
        $this->secret = encrypt($secret);

        return $this;
    }

    /**
     * Get the recovery codes.
     *
     * @return string|null
     */
    public function getRecoveryCodes(): ?string
    {
        return $this->recoveryCodes;
    }

    /**
     * Get the decrypted recovery codes.
     *
     * @param  bool  $asArray
     *
     * @return array|string
     */
    public function getDecryptedRecoveryCodes($asArray = true)
    {
        $codes = decrypt($this->getRecoveryCodes());

        if ($asArray) {
            $codes = json_decode($codes, true);
        }

        return $codes;
    }

    /**
     * Get a valid recovery code.
     *
     * @param  string  $recoveryCode
     *
     * @return string|null
     */
    public function getValidRecoveryCode(string $recoveryCode)
    {
        return Collection::make($this->getDecryptedRecoveryCodes())->first(function ($code) use ($recoveryCode) {
            return hash_equals($recoveryCode, $code) ? $code : null;
        });
    }

    /**
     * Determine if the two factor authentication is enabled.
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return ! empty($this->getSecret());
    }

    /**
     * Get the QR code SVG of the user's two factor authentication QR code URL.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function getQrCodeSvg(): HtmlString
    {
        $url = app(TwoFactorAuthenticationProvider::class)->qrCodeUrl(
            config('app.name'), $this->email, $this->getDecryptedSecret()
        );
        $svg = (new QrCode)->svg($url);

        return new HtmlString(
            trim(substr($svg, strpos($svg, "\n") + 1))
        );
    }
}
