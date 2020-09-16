<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Repositories;

use Arcanesoft\Foundation\Support\Contracts\Repository as RepositoryContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Traits\ForwardsCalls;

/**
 * Class     Repository
 *
 * @package  Arcanesoft\Foundation\Support\Repositories
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
abstract class Repository implements RepositoryContract
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use ForwardsCalls;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the model FQN class.
     *
     * @return string
     */
    abstract public static function modelClass(): string;

    /**
     * Get the model instance.
     *
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function model(): Model
    {
        return app()->make(static::modelClass());
    }

    /**
     * Get the query builder.
     *
     * @return \Illuminate\Database\Eloquent\Builder|mixed
     */
    public function query()
    {
        return $this->model()->newQuery();
    }

    /* -----------------------------------------------------------------
     |  CRUD Methods
     | -----------------------------------------------------------------
     */

    /**
     * Execute the query as a "select" statement.
     *
     * @param  array  $columns
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]|mixed
     */
    public function all($columns = ['*'])
    {
        return $this->get($columns);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get a repository.
     *
     * @param  string  $repo
     *
     * @return \Arcanesoft\Foundation\Support\Repositories\Repository|mixed
     */
    protected static function makeRepository(string $repo): self
    {
        return app()->make($repo);
    }

    /**
     * Pass dynamic methods onto the query instance.
     *
     * @param  string  $method
     * @param  array   $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->forwardCallTo(
            $this->query(), $method, $parameters
        );
    }
}