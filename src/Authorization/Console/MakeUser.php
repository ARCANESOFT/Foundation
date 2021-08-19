<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Console;

use Arcanesoft\Foundation\Authorization\Repositories\UsersRepository;
use Illuminate\Console\Command;

/**
 * Class     MakeUser
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MakeUser extends Command
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
    protected $signature = 'make:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

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
        $this->comment('Creating a new User');

        // TODO: Validate the inputs + password confirmation ?
        call_user_func(static::defaultCreateUserCallback(), ...[
            $this->ask('First Name'),
            $this->ask('Last Name'),
            $this->ask('Email Address'),
            $this->secret('Password')
        ]);

        $this->comment('User created successfully.');

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
            /** @var  \Arcanesoft\Foundation\Authorization\Repositories\UsersRepository  $repo */
            $repo = app(UsersRepository::class);
            $now  = now();

            $repo->forceCreate([
                'first_name'        => $firstName,
                'last_name'         => $lastName,
                'email'             => $email,
                'email_verified_at' => $now,
                'password'          => $password,
                'activated_at'      => $now
            ]);
        };
    }
}
