<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Policies;

use Arcanesoft\Foundation\Authorization\Models\Administrator;
use Arcanesoft\Foundation\Authorization\Models\Session;

/**
 * Class     SessionsPolicy
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SessionsPolicy extends AbstractPolicy
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
        return 'admin::authorization.sessions.';
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
            'category' => 'Sessions',
        ]);

        return [

            // admin::authorization.sessions.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'List all the sessions',
                'description' => 'Ability to list all the sessions'
            ]),

            // admin::authorization.sessions.metrics
            $this->makeAbility('metrics')->setMetas([
                'name'        => "Show the sessions' metrics",
                'description' => "Ability to show the sessions' metrics",
            ]),

            // admin::authorization.sessions.show
            $this->makeAbility('show')->setMetas([
                'name'        => 'Show an session',
                'description' => "Ability to show the session's details",
            ]),

            // admin::authorization.sessions.create
            $this->makeAbility('create')->setMetas([
                'name'        => 'Create a new session',
                'description' => 'Ability to create a new session',
            ]),

            // admin::authorization.sessions.update
            $this->makeAbility('update')->setMetas([
                'name'        => 'Update a session',
                'description' => 'Ability to update a session',
            ]),

            // admin::authorization.sessions.delete
            $this->makeAbility('delete')->setMetas([
                'name'        => 'Delete a session',
                'description' => 'Ability to delete a session',
            ]),

        ];
    }

    /* -----------------------------------------------------------------
     |  Abilities
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the sessions.
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
     * Allow to list all the sessions' metrics.
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
     * Allow to show a session details.
     *
     * @param \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param \Arcanesoft\Foundation\Authorization\Models\Session|null         $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function show(Administrator $administrator, Session $model = null)
    {
        //
    }

    /**
     * Allow to create a session.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function create(Administrator $administrator)
    {
        //
    }

    /**
     * Allow to update a session.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Authorization\Models\Session|null         $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function update(Administrator $administrator, Session $model = null)
    {
        //
    }

    /**
     * Allow to delete a session.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Authorization\Models\Session|null         $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function delete(Administrator $administrator, Session $model = null)
    {
        //
    }
}
