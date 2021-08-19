<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Policies;

use Arcanesoft\Foundation\Authorization\Models\Administrator;

/**
 * Class     SettingsPolicy
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SettingsPolicy extends AbstractPolicy
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
        return 'admin::authorization.settings.';
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
            'category' => 'Settings',
        ]);

        return [

            // admin::authorization.settings.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'List all the settings',
                'description' => 'Ability to list all the settings',
            ]),

        ];
    }

    /* -----------------------------------------------------------------
     |  Abilities
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the settings.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function index(Administrator $administrator)
    {
        //
    }
}
