<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Policies;

use Arcanesoft\Foundation\Authorization\Models\Administrator;

/**
 * Class     RouteViewerPolicy
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteViewerPolicy extends AbstractPolicy
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
        return 'admin::system.route-viewer.';
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
            'category' => 'Route Viewer',
        ]);

        return [

            // admin::foundation.system.route-viewer.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'Show all the routes',
                'description' => 'Ability to show all the routes',
            ]),

        ];
    }

    /* -----------------------------------------------------------------
     |  Policies
     | -----------------------------------------------------------------
     */

    /**
     * Allow to access all the routes.
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
