<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Providers;

use Arcanesoft\Foundation\Support\Providers\Concerns\HasPolicyClasses;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * Class     AuthServiceProvider
 *
 * @package  Arcanesoft\Foundation\Support\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class AuthServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasPolicyClasses;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        $this->registerPolicyClasses();
    }
}