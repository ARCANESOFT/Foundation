<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Policies;

use Arcanesoft\Foundation\Authorization\Models\Administrator;

/**
 * Class     DependenciesPolicy
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DependenciesPolicy extends AbstractPolicy
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
        return 'admin::system.dependencies.';
    }

    /**
     * Get the abilities.
     *
     * @return \Arcanedev\LaravelPolicies\Ability[]|iterable
     */
    public function abilities(): iterable
    {
        $this->setMetas([
            'category' => 'System - Dependencies',
        ]);

        return [

            // admin::system.abilities.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'List all the dependencies',
                'description' => 'Allows to list all the dependencies',
            ]),

            // admin::system.abilities.show
            $this->makeAbility('show')->setMetas([
                'name'        => 'Show a dependency\'s details',
                'description' => 'Allows to show the dependency\'s details',
            ]),

        ];
    }

    /* -----------------------------------------------------------------
     |  Policies
     | -----------------------------------------------------------------
     */

    /**
     * Allow to access all the dependencies.
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
     * Allow to access all the dependency.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function show(Administrator $administrator)
    {
        //
    }
}
