<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization;

use Arcanesoft\Foundation\Authorization\Models\Administrator;
use Arcanesoft\Foundation\Authorization\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Arcanesoft\Foundation\Authorization\Console\{MakeAdmin, MakeUser};
use Arcanesoft\Foundation\Support\Providers\ServiceProvider;

/**
 * Class     AuthServiceProvider
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AuthServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerProviders([
            Providers\EventServiceProvider::class,
            Providers\RouteServiceProvider::class,
            Providers\SessionServiceProvider::class,
            Providers\ViewServiceProvider::class,
        ]);

        $this->registerCommands([
            MakeUser::class,
            MakeAdmin::class,
        ]);
    }

    public function boot(): void
    {
        Relation::morphMap([
            'administrator' => Auth::model('administrator', Administrator::class),
            'user'          => Auth::model('user', User::class),
        ]);
    }
}
