<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Policies;

use Arcanesoft\Foundation\Authorization\Models\Administrator;

/**
 * Class     PasswordResetsPolicy
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PasswordResetsPolicy extends AbstractPolicy
{
    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the ability's prefix.
     *
     * @return string
     */
    protected static function prefix(): string
    {
        return 'admin::authorization.password-resets.';
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the policy's abilities.
     *
     * @return \Arcanedev\LaravelPolicies\Ability[]|iterable
     */
    public function abilities(): iterable
    {
        $this->setMetas([
            'category' => 'Password Resets',
        ]);

        return [

            // admin::authorization.password-resets.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'List all the password resets',
                'description' => 'Ability to list all the password resets',
            ]),

            // admin::authorization.password-resets.metrics
            $this->makeAbility('metrics')->setMetas([
                'name'        => "List all the password resets' metrics",
                'description' => "Ability to list all the password resets' metrics",
            ]),

            // admin::authorization.password-resets.delete
            $this->makeAbility('delete')->setMetas([
                'name'        => 'Delete a password reset',
                'description' => 'Ability to delete a password reset',
            ]),

        ];
    }

    /* -----------------------------------------------------------------
     |  Abilities
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the password resets.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function index(Administrator $administrator)
    {
        //
    }

    /**
     * Allow to access the password resets' metrics.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function metrics(Administrator $administrator)
    {
        //
    }

    /**
     * Allow to delete a password reset.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function delete(Administrator $administrator)
    {
        //
    }
}
