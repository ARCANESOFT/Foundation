<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Models;

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Fortify\Contracts\TwoFactorAuthenticationProvider;
use Arcanesoft\Foundation\Fortify\Services\TwoFactorAuthentication\QrCode;
use Illuminate\Support\HtmlString;

/**
 * Class     TwoFactor
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  int                         id
 * @property  int                         two_factorable_id
 * @property  string                      two_factorable_type
 * @property  string                      secret
 * @property  string                      recovery_codes
 * @property  \Illuminate\Support\Carbon  created_at
 * @property  \Illuminate\Support\Carbon  updated_at
 *
 * @property  \Arcanesoft\Foundation\Auth\Models\Administrator|\Arcanesoft\Foundation\Auth\Models\User|mixed  two_factorable
 *
 * @property-read  string                          decrypted_secret
 * @property-read  array                           decrypted_recovery_codes
 * @property-read  \Illuminate\Support\HtmlString  qr_code_svg
 */
class TwoFactor extends Model
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'secret',
        'recovery_codes',
    ];

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->setConnection(config('arcanesoft.auth.database.connection'));
        $this->setTable(Auth::table('two_factors'));

        parent::__construct($attributes);
    }

    /* -----------------------------------------------------------------
     |  Relationships
     | -----------------------------------------------------------------
     */

    /**
     * Get the owning two factorable model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function two_factorable()
    {
        return $this->morphTo();
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    public function setSecretAttribute(string $secret)
    {
        $this->attributes['secret'] = encrypt($secret);
    }

    /**
     * Get the `decrypted_secret` attribute.
     *
     * @return string
     */
    public function getDecryptedSecretAttribute(): string
    {
        return decrypt($this->secret);
    }

    /**
     * Get the `decrypted_recovery_codes` attribute.
     *
     * @return mixed
     */
    public function getDecryptedRecoveryCodesAttribute()
    {
        return json_decode(decrypt($this->recovery_codes));
    }

    /**
     * Set the `recovery_codes` attributes.
     *
     * @param  array  $recoveryCodes
     */
    public function setRecoveryCodesAttribute(array $recoveryCodes)
    {
        $this->attributes['recovery_codes'] = encrypt(json_encode($recoveryCodes));
    }

    /**
     * Get the `qr_code_svg` attribute.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function getQrCodeSvgAttribute(): HtmlString
    {
        $url = app(TwoFactorAuthenticationProvider::class)->qrCodeUrl(
            config('app.name'), $this->two_factorable->email, $this->decrypted_secret
        );

        $svg = (new QrCode)->svg($url);

        return new HtmlString(
            trim(substr($svg, strpos($svg, "\n") + 1))
        );
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get a valid recovery code.
     *
     * @param  string  $code
     *
     * @return string|null
     */
    public function getValidRecoveryCode(string $code)
    {
        foreach ($this->decrypted_recovery_codes as $recoveryCode) {
            if (hash_equals($code, $recoveryCode))
                return $recoveryCode;
        }

        return null;
    }
}
