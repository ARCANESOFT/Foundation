<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Contracts;

/**
 * Interface     TwoFactorAuthenticationProvider
 *
 * @package  Arcanesoft\Foundation\Fortify\Contracts
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface TwoFactorAuthenticationProvider
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Generate a new secret key.
     *
     * @return string
     */
    public function generateSecretKey(): string;

    /**
     * Get the two factor authentication QR code URL.
     *
     * @param  string  $companyName
     * @param  string  $companyEmail
     * @param  string  $secret
     *
     * @return string
     */
    public function qrCodeUrl($companyName, $companyEmail, $secret);

    /**
     * Verify the given token.
     *
     * @param  string  $secret
     * @param  string  $code
     *
     * @return bool
     */
    public function verify($secret, $code);
}
