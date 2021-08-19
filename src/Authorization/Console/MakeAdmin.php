<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Console;

use Arcanesoft\Foundation\Authorization\Models\Role;
use Arcanesoft\Foundation\Authorization\Repositories\AdministratorsRepository;
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
    public function handle(): int
    {
        $this->newLine();
        $this->comment('Creating a new Admin');

        // TODO: Validate the inputs + password confirmation ?
        call_user_func(static::defaultCreateUserCallback(), ...[
            $this->ask('First Name'),
            $this->ask('Last Name'),
            $this->ask('Email Address'),
            $this->secret('Password')
        ]);

        $this->comment('Admin created successfully.');

        return static::SUCCESS;
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the default callback used for creating new Nova users.
     *
     * @return callable
     */
    protected static function defaultCreateUserCallback(): callable
    {
        return function (string $firstName, string $lastName, string $email, string $password): void {
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
     * @return \Arcanesoft\Foundation\Authorization\Repositories\AdministratorsRepository
     */
    protected static function getAdministratorsRepository(): AdministratorsRepository
    {
        return app(AdministratorsRepository::class);
    }
}
