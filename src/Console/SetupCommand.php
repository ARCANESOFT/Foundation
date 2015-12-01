<?php namespace Arcanesoft\Foundation\Console;

use Arcanedev\Support\Bases\Command;

/**
 * Class     SetupCommand
 *
 * @package  Arcanesoft\Foundation\Console
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SetupCommand extends Command
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'foundation:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Foundation setup command.';

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->createAdminUser();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Create an admin user.
     */
    private function createAdminUser()
    {
        $user = new \Arcanesoft\Auth\Models\User([
            'username'   => 'admin',
            'first_name' => 'John',
            'last_name'  => 'DOE',
            'email'      => env('ADMIN_EMAIL', 'admin@example.com'),
            'password'   => env('ADMIN_PASSWORD', 'password'),
        ]);

        $user->is_admin  = true;
        $user->is_active = true;

        $user->save();

        $this->info('Admin account created !');
    }
}
