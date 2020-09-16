<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Policies;

use Arcanesoft\Foundation\Auth\Models\Administrator;

/**
 * Class     InformationPolicy
 *
 * @package  Arcanesoft\Foundation\System\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class InformationPolicy extends AbstractPolicy
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
        return 'admin::system.';
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
            'category' => 'System Information',
        ]);

        return [

            // admin::foundation.system.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'Show all the system information',
                'description' => 'Ability to show all the system information',
            ]),

        ];
    }

    /* -----------------------------------------------------------------
     |  Policies
     | -----------------------------------------------------------------
     */

    /**
     * Allow to access all the system information.
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
