<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Policies;

use Arcanesoft\Foundation\Auth\Models\Administrator;

/**
 * Class     SettingsPolicy
 *
 * @package  Arcanesoft\Foundation\Auth\Policies
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
        return 'admin::auth.settings.';
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

            // admin::auth.settings.index
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
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator|mixed  $administrator
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function index(Administrator $administrator)
    {
        //
    }
}
