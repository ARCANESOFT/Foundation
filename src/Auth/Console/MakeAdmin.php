<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Console;

use Arcanesoft\Foundation\Auth\Models\Role;
use Arcanesoft\Foundation\Auth\Repositories\AdministratorsRepository;
use Closure;
use Illuminate\Console\Command;

/**
 * Class     MakeAdmin
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MakeAdmin extends Command
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the command.
     */
    public function handle(): void
    {
        $this->line('');
        $this->comment('Creating a new Admin');

        call_user_func(static::defaultCreateUserCallback(), ...[
            $this->ask('First Name'),
            $this->ask('Last Name'),
            $this->ask('Email Address'),
            $this->secret('Password')
        ]);

        $this->comment('Admin created successfully.');
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the default callback used for creating new Nova users.
     *
     * @return \Closure
     */
    protected static function defaultCreateUserCallback(): Closure
    {
        return function (string $firstName, string $lastName, string $email, string $password) {
            $repo = static::getAdministratorsRepository();

            $administrator = $repo->createOne([
                'first_name'   => $firstName,
                'last_name'    => $lastName,
                'email'        => $email,
                'password'     => $password,
                'activated_at' => now(),
            ]);

            $repo->syncRolesByKeys($administrator, [Role::ADMINISTRATOR]);
        };
    }

    /**
     * Get the administrators repository.
     *
     * @return \Arcanesoft\Foundation\Auth\Repositories\AdministratorsRepository
     */
    protected static function getAdministratorsRepository(): AdministratorsRepository
    {
        return app(AdministratorsRepository::class);
    }
}
