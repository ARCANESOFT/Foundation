<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Policies;

use Arcanesoft\Foundation\Auth\Models\Administrator;

/**
 * Class     DashboardPolicy
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DashboardPolicy extends AbstractPolicy
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
        return 'admin::auth.statistics.';
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
            'category' => 'Dashboard',
        ]);

        return [

            // admin::auth.statistics.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'Show all the statistics',
                'description' => 'Ability to show all the statistics',
            ]),

        ];
    }

    /* -----------------------------------------------------------------
     |  Abilities
     | -----------------------------------------------------------------
     */

    /**
     * Allow to access all the auth stats.
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
